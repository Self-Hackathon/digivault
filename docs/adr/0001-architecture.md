# 0001 - Architecture: API-first, Monorepo, Contract-Driven

- **Date**: 2025-08-19
- **Status**: Accepted
- **Owner**: @putradwinandap
- **Context**: Digivault (single-seller digital goods). MVP Focus: fast checkout, secure payments, and delivery via signed URL

---

## 1. Decision

1. **API-first & contract-driven**
- All FE/BE integrations rely on **OpenAPI (docs/api/openapi.yaml)** as the *source of truth*.
- FE and BE can run in parralel using a **mock server** of the contract.

2. **Monorepo on Github**
- Structure: `apps/web` (Next.js), `apps/api` (backend), `packages/` (shared lib/types), `docs/` (PRD/ADR/RFC/API/diagrams), `infra/` (docker compose).
- Branch `main` **protected**; PR + green CI required.

3. **Backend: RESTful service (stack TBD)**

- Stack selection simplified (criteria: speed of delivery + payment ecosystem + ease of deployment).
- **DB**: PostgreSQL.
- **Object storage**: S3-compatible (MinIO in dev, S3 in prod).
- **Payment gateway**: via adapter pattern (Stripe/Xendit/Paypal, sandbox first).

4. **High-security delivery**

- **Signed URL** (short expiry) + rate limit per order.
- **Webhook** verified signature + **idempotent** (dedup by `event_id`).

5. **Observability & Quality**
- CI: list, test, **OpenAPI validate**.
- Structured logging & basic metrics (request latency, error rate).
- **SemVer** + **Keep a Changelog** for releases.

---

## 2. Context

- MVP requirements: simple single-seller store, fast releases, yet clean.
- API-first helps parallel FE/BE, prevents *scope creep*, and enforces clear data definitions.
- Monorepo facilitates coordination, share types, and provides a single CI/CD gateway.

---

## 3. Architecture Overview

**Component**
- **Web (Next.js)**: catalog, details, checkout, success (take delivery).
- **API (REST)**: products, checkout session, webhook payment, delivery links.
- **PostgreSQL**: `users`, `products`, `orders`, `order_items`, `license`, `downloads`, `webhook_events`.
- **S3-compatible storage**: private digital files -> signed URL on delivery.
- **Payment Gateway**: checkout redirect + notification webhook.

**Short flow**
1. FE calls `POST /checkout` -> API create pending order + payment session.
2. User pays at the gateway -> gateway sends **webhook** to API.
3. API signature verification + idempotent -> mark paid, issue license, save delivery link.
4. FE calls `GET /orders/{id}/delivery` -> gets signed URL & license keys.

The sequence diagram and ERD are located at:
- `docs/diagrams/checkout-sequence.puml`
- `docs/diagrams/erd.puml`

---

## 4. Scope & Non-Goals

**Scope (v0)**
- Guest checkout with email.
- Public REST API for catalog/checkout/delivery.
- Minimal admin (product CRUD) in v0/0.1.x.

**Non-Goals (v0)**
- Subscription/recurring, coupon/affiliate, complex tax engine.

---

## 5. Security & Compliance

**Webhook**
- Verify gateway signature; reject if timestamps is too old.
- **Idempotency**: simpan `event_id`; ignore duplicates.

**Delivery**
- Signed URL expires <= 1 hour.
- Audit log `downloads` (ip, ua, ts).

**Auth & RBAC**
- Single `users` table (buyer & staff).
- **RABC** in DB: `roles`, `permissions`, `user_roles`,
- Admin/staff **required** MFA/SSO; buyer optional (guest allowed).
- Middleware checks permissions per route (least privilege)
- Audit: save `auth_logs` (login success/fail, ip, ua, ts).

**Secrets**
- Use Github Environments (`dev/staging/prod`) + protected deploy.

**Rate limiting**
- Per IP/email for `POST /checkout` and delivery access.

## 6. Quality Gates

- **OpenAPI validation** must pass in CI.
- **Contract tests** (schema compatibility) between FE & BE.
- Unit + integration for order/payment/delivery domains.
- E2E “happy path” (checkout -> pay -> download) via Playwright/Cypress.
- Smoke perfomance (light k6) target p95 < 300ms (deb baseline).

---

## 7. Alternatives Considered

**Polyrepo (separated FE & BE)**
- \+ Clear isolation, suitable for large teams.
- \- Tooling/CI overhead ffir small teams, difficult to sync changes.
**Rejected for v0**.

**GraphQL**
- \+ Flexible FE queries.
- \- Overkill for simple checkout MVP; Heavier tooling. **Postponed**

## 8. Consequencese

**Positive**
- Parallel FE/BE, reduced risk of contract errors.
- Controlled API changes (SemVer + changelog).

**Negative / Trade-offs**
- Disciplined OpenAPI/ADR updates for every major change.

## 9. Implementation Notes
- Create `docs/api/openapi.yaml` minimal endpoints.
- `GET /products`
- `POST /checkout`
- `POST /webhook/payment`
- `GET /orders/{id}/delivery`
- Set up a **mock server** (Prism/Swagger) for FE.
- `payment/` adapter for gateway to easily switch vendors.
- Index DB: `orders(created_at, status)`, `order_items(order_id)`, `licenses(order_id, product_id)`.

## 10. Links

- PRD: `docs/prd/PRD-digivault.md`
- Diagrams: `docs/diagrams/*`
- OpenAPI: `docs/api/openapi.yaml`
- Standards: SemVer, Conventional Commits, Keep a Changelog.

---

## 11. Change Log

- **2025-08-19**: Initial acceptance. API‑first, monorepo, REST, S3 storage, payment via adapter.