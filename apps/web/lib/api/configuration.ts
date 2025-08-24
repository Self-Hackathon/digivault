import { Configuration } from "@/openapi/configuration"

export const apiConfig = new Configuration({
  basePath: process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000/api",
});
