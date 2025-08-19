import { Configuration } from "@/sdk/configuration";
import { http } from "./http";

export const apiConfig = new Configuration({
  basePath: process.env.NEXT_PUBLIC_API_URL || "http://localhost:3000/api",
});

export { http };
