import { verifySession } from "@/lib/dal"

export type ClientSessionDTO = {
    id: number
    email: string
    is_active: boolean
} | null

export async function getClientSessionDTO(): Promise<ClientSessionDTO> {
    const full = await verifySession();
    console.log(full);

    if (!full) {
        return null
    }

    return {
        id: full.user.id,
        email: full.user.email,
        is_active: full.user.is_active,
    }
}
