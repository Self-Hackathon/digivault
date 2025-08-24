// /lib/session-context.tsx (Client)
"use client"
import { createContext, useContext } from "react"
import type { ClientSessionDTO } from "./session"

const SessionContext = createContext<ClientSessionDTO>(null)
export const useSession = () => useContext(SessionContext)

export function SessionProvider({
  value,
  children,
}: {
  value: ClientSessionDTO
  children: React.ReactNode
}) {
  return <SessionContext.Provider value={value}>{children}</SessionContext.Provider>
}
