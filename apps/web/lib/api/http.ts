import axios, { AxiosError, InternalAxiosRequestConfig } from "axios";

export const http = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000/api",
  withCredentials: true,
});

function getCookie(name: string) {
  if (typeof document === "undefined") return null;
  const m = document.cookie.match(new RegExp(`(?:^|; )${name}=([^;]*)`));
  return m ? decodeURIComponent(m[1]) : null;
}

class CsrfGuard {
  private inflight: Promise<void> | null = null;
  private lastFetchedAt = 0;
  private minRefreshMs = 60_000; 

  constructor(private endpoint = "/sanctum/csrf-cookie") {
  } 

  private hasCookie() {
    return Boolean(getCookie("XSRF-TOKEN"));
  }

  async ensure() {
    if (this.hasCookie() && Date.now() - this.lastFetchedAt < this.minRefreshMs) return;

    if (!this.inflight) {
      this.inflight = (async () => {
        try {
          await http.get(this.endpoint, { withCredentials: true });
          this.lastFetchedAt = Date.now();
        } finally {
          this.inflight = null;
        }
      })();
    }
    await this.inflight;
  }

  async refresh() {
    this.lastFetchedAt = 0;
    await this.ensure();
  }
}

const csrf = new CsrfGuard(
  "/sanctum/csrf-cookie"
);

http.interceptors.request.use(
  async (config: InternalAxiosRequestConfig) => {
    const url = (config.url || "").toString();
    if (!url.includes("/csrf")) {
      await csrf.ensure();
    }
    return config;
  }
);

http.interceptors.response.use(
  (res) => res,
  async (error: AxiosError) => {
    const status = error.response?.status;
    const original = error.config as InternalAxiosRequestConfig & { _retried?: boolean };

    if (!original?._retried && (status === 419 || status === 401)) {
      original._retried = true;
      await csrf.refresh();
      return http(original);
    }

    return Promise.reject(error);
  }
);

export default http;