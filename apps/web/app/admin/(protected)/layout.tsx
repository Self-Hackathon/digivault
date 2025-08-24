"use server"

import { redirect } from 'next/navigation'
import { getClientSessionDTO } from '@/lib/session'
import { SessionProvider } from "@/lib/session-context"

export default async function BlogLayout({
    children,
}: {
    children: React.ReactNode
}) {

    const session = await getClientSessionDTO()

    console.log(session);

    if (!session) {
        redirect('/admin/auth/login')
    }

    return (
        <SessionProvider value={session}>{children}</SessionProvider>
    )
}