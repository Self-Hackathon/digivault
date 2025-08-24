# 1. Base image
FROM node:20-alpine AS base
WORKDIR /app

# 2. Install deps (cache this layer)
COPY package*.json ./
RUN npm ci

# 3. Build stage
FROM base AS builder
COPY . .
RUN npm run build

# 4. Runtime stage
FROM node:20-alpine AS runner
WORKDIR /app
ENV NODE_ENV=production
ENV PORT=3000

# copy package.json to runtime
COPY package*.json ./
RUN npm ci --omit=dev

COPY --from=builder /app/.next .next
COPY --from=builder /app/public public
COPY --from=builder /app/next.config.ts ./

EXPOSE 3000
CMD ["npm", "start"]