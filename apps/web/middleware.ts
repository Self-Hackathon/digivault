import { NextResponse } from 'next/server'
import type { NextRequest } from 'next/server'

const protectedPrefix = '/admin'
const publicRoutes = ['/admin/auth']

export function middleware(req: NextRequest) {
  const path = req.nextUrl.pathname

  const isPublic = publicRoutes.some(route => path.startsWith(route))
  const isProtected = path.startsWith(protectedPrefix) && !isPublic

  const session = req.cookies.get('digivault-session')?.value

  if (isProtected && !session) {
    return NextResponse.redirect(new URL('/admin/auth/login', req.url))
  }

  if (isPublic && session) {
    return NextResponse.redirect(new URL('/admin', req.url))
  }

  return NextResponse.next()
}

export const config = {
  matcher: ['/((?!api|_next/static|_next/image|.*\\.png$).*)'],
}
