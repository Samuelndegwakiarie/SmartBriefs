Feature 1: User Registration / Login

Email + password authentication using Laravel Breeze.

Session-based login for web users.

Password hashing and validation.

Feature 2: Create / Read / Update / Delete Briefs

Each brief includes:

Title

Content

Optional attachment (file upload)

User can manage their own briefs only.

CRUD endpoints and Blade views for managing briefs.

Feature 3: AI Actions on a Brief

Integrate Claude and Gemini for text enhancements:

Summarize: Generate concise summaries.

Generate Tags: Extract 3–6 keywords.

Rewrite: Offer 3 rewrite tones — Formal, Friendly, Shorter.

Use queued jobs for API requests (async processing).

Store AI responses per brief for later reference.

Feature 4 (ignored as per instructions):

(Activity log omitted for MVP scope.)

Feature 5: Admin View

Restricted to admin users.

Admin can view:

List of all users

List of all briefs

Optional if time permits (target Day 4).

Feature 6: Small REST API

Public REST endpoints for fetching briefs (for future frontend/mobile app).

Example endpoints:

GET /api/briefs → list all briefs

GET /api/briefs/{id} → single brief with AI responses
