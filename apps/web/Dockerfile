# apps/web/Dockerfile

# 1. Build stage
FROM node:20-alpine AS builder

WORKDIR /app

# install deps
COPY package.json package-lock.json ./
RUN npm ci

# copy source
COPY . .

# build Next.js
RUN npm run build

# 2. Runtime stage
FROM node:20-alpine AS runner

WORKDIR /app

ENV NODE_ENV=production
ENV PORT=3000

# hanya copy hasil build & deps produksi
COPY --from=builder /app/package.json /app/package-lock.json ./
RUN npm ci --omit=dev

COPY --from=builder /app/.next .next
COPY --from=builder /app/public public
COPY --from=builder /app/next.config.js ./

EXPOSE 3000

CMD ["npm", "start"]