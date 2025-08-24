import 'server-only'
import { cache } from 'react'
import {
    AuthApi
} from '@/openapi/api';
import { cookies } from 'next/headers'
import { apiConfig } from "./api/configuration";
import axios from 'axios'

class SessionMissingError extends Error {
    constructor(msg = "Session data missing") { super(msg); this.name = "SessionMissingError"; }
}

export const clearAuthCookies = async () => {
    (await cookies()).delete('digivault-session');
    (await cookies()).delete('XSRF-TOKEN');
}

export const verifySession = cache(async () => {
    const digivault_session = (await cookies()).get('digivault-session')?.value
    const XSRF_TOKEN = (await cookies()).get('XSRF-TOKEN')?.value

    const http = axios.create({
        baseURL: process.env.NEXT_API_INTERNAL_URL || "http://dv-api:9000/api",
        headers: {
            ...(digivault_session || XSRF_TOKEN
                ? {
                    Cookie: [
                        digivault_session ? `digivault-session=${digivault_session}` : null,
                        XSRF_TOKEN ? `XSRF-TOKEN=${XSRF_TOKEN}` : null,
                    ]
                        .filter(Boolean)
                        .join("; "),
                }
                : {}),
            ...(XSRF_TOKEN ? { "X-XSRF-TOKEN": XSRF_TOKEN } : {}),
            Accept: "application/json",
        },
    });

    const authApi = new AuthApi(apiConfig, apiConfig.basePath, http);

    try {
        const { data: me } = await authApi.authMeGet()
        const res = me.data

        if (!res) throw new SessionMissingError();

        return {
            isAuth: true, user: {
                'id': res.id,
                'email': res.email,
                'is_active': res.is_active,
            }
        }
    } catch (err: unknown) {
        if (axios.isAxiosError(err) && err.response?.status === 401) {
            clearAuthCookies();
        }

        if (err instanceof SessionMissingError) {
            clearAuthCookies();
        }

        return null;
    }
})