import { apiConfig } from "./configuration";
import {
    AuthApi
} from '@/openapi/api';
import { http } from "./http";

export const authApi = new AuthApi(apiConfig, apiConfig.basePath, http);

export { http };