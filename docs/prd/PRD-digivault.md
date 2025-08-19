# Product Requirements Document – Digivault (v0)

## 1. Summary

Digivault is a single-seller website for selling digital products (e.g., PDF, ZIP, license keys).
MVP Focus: buyers can quickly checkout, pay, and then immediately receive a secure download link and proof of purchase email.

---

## 2. Persona & Jobs

**Buyers in a hurry**
 - Job: Buy -> Pay -> Download immediately.
 - Pain: Leaked  links, complicated process.
 
**Admin (owner)**
 - Job: Upload products, set, prices, monitor sales.
 - Pain: Complicated manual file and license management.

 ---

## 3. User Stories & Acceptance

**US-1 Checkout as a guest**
- *Given* I put the product in my cart
- *When* I enter my email and successfully pay
- *Then* I receive a unique download link and email receipt.

**US-2 Admin CRUD Product**
- *Given* I log in as admin
- *When* I enter the name, price, and file
- *Then* the product is available in the catalog.

**US-3 Safe Delivery**
- *Given* my order has been paid
- *When* I open the download link
- *Then* valid link <= 1 hour.

---

## 4. MVP Features

- Simple Auth (guest checkout + admin login).
- Product catalog (list+details).
- One-page checkout(cart, email, pay).
- Payment gateway integration (sandbox -> live).
- Payment webhook (idempotent + signature verification).
- Secure download (signed URL, expiring).
- Email receipt (payment confirmation + download link).
- Minimal admin (product CRUD + basic sales report).

---

## 5. Out of Scope v0

- Subscription / recurring billing.
- Affiliate / coupon system.
- Advanced analytics.