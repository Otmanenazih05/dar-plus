<img src="https://r2cdn.perplexity.ai/pplx-full-logo-primary-dark%402x.png" style="height:64px;margin-right:32px"/>

# Alright, based on these details you gave me, I want you to do more research about some similar web apps like this and get inspirations, then I want you to create me a deatiled file that have a prompt to create each seacion with its pages, I want modern, soft design in light mode and not dark with a design and colors that fit the idea of the app very well, and I don't want something very super or hard, because as you know I don't have all the time and the committee will notice that it's all created via ai if it's something very hard, but be creative also I don't want something cheap. So, a file that has a prompt to create each seacion with its pages + a prompt in the begining for the core colors and style that the Google Stitch should follow (MASTER STYLE BRIEF) + the FINAL DESIGN NOTES FOR STITCH, so I can every time give it a prompt that has the MASTER STYLE BRIEF + the individual section prompt below it + the FINAL DESIGN NOTES FOR STITCH. Be detailed, creative and professional please and do you research before anything to get inspirations and info about how the design for similar ideas should be and do what I ask you for the simplicity but keep it nice and good looking also to not appear cheap. USE THIS NAME FOR THE APP: "Dar+".

I researched similar products and prepared a complete ready-to-use prompt pack for **Dar+** that stays modern, soft, and believable for a student internship project rather than looking unrealistically overdesigned. Zillow emphasizes search, saved listings, sharing, neighborhood context, and immersive listing media; Rightmove highlights maps, larger imagery, floor plans, account syncing, and video-tour callouts; Property Finder supports multiple property types and direct contact options including WhatsApp; and Houzz shows how photo-led interfaces can feel warm and aspirational without becoming visually heavy.[^1][^2][^3][^4][^5][^6][^7][^8]

## Inspiration

For **Dar+**, the right inspiration mix is: Zillow for structured discovery, Rightmove for practical listing presentation, Property Finder for MENA-relevant contact behavior, and Houzz for calm, image-first home aesthetics. I also used Behance and Dribbble only as broad inspiration pools for modern real-estate UI direction, but the prompts below intentionally avoid flashy AI-looking complexity so the final design feels polished, simple, and credible for your timeframe.[^3][^4][^5][^7][^8][^9][^10][^11][^12]

## Master Style Brief

Use this at the **top of every Stitch prompt**:

```text
MASTER STYLE BRIEF — Dar+

Design a modern light-mode web app called “Dar+” for discovering, listing, and messaging about real estate properties. The app is focused on structured, professional property presentation for apartments, villas, land, commercial spaces, and houses. The core idea is that sellers must follow a category-based blueprint to upload the right photos, videos, and property details, so buyers get trustworthy and complete listings.

Overall visual direction:
- Light mode only
- Modern, soft, clean, elegant, calm
- Professional and realistic, not futuristic, not flashy, not luxury-excessive
- Friendly enough for a broad audience, but still premium and organized
- Slightly social-media influenced in layout simplicity, but clearly a real estate product
- The app should feel trustworthy, airy, and image-led
- Avoid complex futuristic dashboards or extreme animations
- Avoid dark mode, neon colors, glassmorphism overload, or very high-tech startup aesthetics
- Avoid generic “cheap marketplace” look
- Avoid crowded cards and overdecorated screens

Design keywords:
soft minimal, airy spacing, rounded but not bubbly, warm neutral, clean hierarchy, photo-first, modern Moroccan-friendly real estate platform, trustworthy, approachable, clear, structured

Brand name:
Dar+

Brand meaning:
“Dar” refers to home/house, and the “+” suggests added quality, better documentation, and a smarter property experience.

Color palette:
- Primary: muted teal / deep soft green-blue (#1F7A7A or close)
- Secondary: warm sand / beige (#E9DCCB or close)
- Accent: soft terracotta / clay (#C97B63 or close, used sparingly)
- Background: warm off-white (#FAF8F5 or close)
- Surface cards: white and slightly warm ivory
- Borders: very light warm gray
- Text primary: dark charcoal, not pure black
- Text secondary: muted gray-brown
- Success/completion: soft olive green
- Warning/incomplete: muted amber

Color usage rules:
- Use teal as the main product color for key actions, active states, links, and badges
- Use beige and warm ivory for backgrounds and section separation
- Use terracotta only for small accents, highlights, icons, and selected decorative moments
- Keep most of the UI neutral and let property photos bring life
- Never make the interface too colorful

Typography:
- Clean modern sans-serif
- Simple, readable, web-app friendly
- Medium-weight headings, regular body text
- Big headings should feel editorial but still realistic for a real product
- Strong hierarchy, no tiny text, no decorative font styles

UI style:
- Rounded corners around 12–18px depending on component
- Soft shadows, subtle borders
- Spacious layout
- Clear cards
- Large property thumbnails
- Structured information blocks
- Minimal icon usage
- Icons should be simple outline icons

Component behavior:
- Prioritize clear search, filters, listing cards, and structured forms
- Multi-step seller flow must feel easy and guided
- Property detail pages must feel complete, organized, and trustworthy
- Messaging should be simple and familiar
- Completion badges and blueprint progress should be visible and useful
- Use labels like “Fully Documented”, “Needs More Details”, “Verified Info”, “Step 2 of 4”

Layout behavior:
- Desktop-first web app layout, but keep components responsive
- Clean top navigation
- Optional left filter sidebar on search/explorer desktop versions
- Mobile versions can use bottom navigation, but prioritize web app desktop mockups unless specified
- Keep screen designs implementation-friendly and realistic for React + Tailwind

Image direction:
- Use large real-estate photography blocks
- Bright interiors, natural light, organized spaces
- Focus on property visuals, room photos, facade, kitchen, living room, bedroom, bathroom, terrace
- Visual storytelling should support trust and completeness

What makes Dar+ different:
- Structured property blueprint by category
- Required media slots for each property type
- Completion score for listing quality
- Better visual and informational trust than generic marketplaces

Stitch goal:
Generate UI screens that are elegant, modern, and simple enough to build within a short internship period. The result should look credible, polished, and smart, but not too advanced or unrealistic.
```


## Section Prompts

Below, each block is meant to be used as: **MASTER STYLE BRIEF + one section prompt + FINAL DESIGN NOTES FOR STITCH**.

### Section 1 — Landing + Auth

```text
SECTION PROMPT — Dar+ / Landing + Authentication

Create a complete UI design section for Dar+ that includes these pages:
1. Landing Page
2. Register Page
3. Login Page
4. Forgot Password Page (simple, optional but useful)

Design intent:
This section is the public face of Dar+. It should immediately communicate trust, property quality, and structured listing standards. The design should feel welcoming, clean, and modern, with soft real-estate photography and calm product framing.

Page 1 — Landing Page
Include:
- Clean top navbar with Dar+ logo, links (Explorer, How it works, Categories, Sign in), and primary CTA “List a Property”
- Hero section with a strong but simple headline about better property listings
- Short supporting paragraph explaining that Dar+ helps sellers present properties with complete photos, videos, and details
- Search bar in hero for city / category / keyword
- Hero image area with 1 large property photo and 1–2 smaller supporting cards or image blocks
- “How Dar+ works” section with 3 steps for sellers and 3 steps for buyers
- “Why Dar+ is different” section showing blueprint-based listing, structured media, and better buyer trust
- Featured categories section with cards: Apartment, Villa, House, Land, Commercial
- Featured listings preview section with 3–4 property cards
- Small trust/quality section with badges like “Structured details”, “Required room photos”, “Direct messaging”
- Simple CTA banner near footer
- Elegant footer with brand, links, and contact placeholders

Landing page style notes:
- Warm light backgrounds with section separation
- Big clean hero
- Strong but not overly marketing-heavy
- Use property photography and soft cards
- Avoid startup cliché gradients
- The page should feel like a calm modern marketplace for real estate

Page 2 — Register Page
Include:
- Split or centered layout
- Role selection first: Buyer or Seller as 2 attractive selectable cards
- Clean registration form with full name, email, phone, city, password, confirm password
- Optional profile image upload area
- If seller is selected, show a subtle section for seller profile info
- Supporting text explaining seller accounts can post structured listings
- Link to sign in
- Optional decorative side image or illustration panel on desktop

Page 3 — Login Page
Include:
- Email and password fields
- Remember me checkbox
- Forgot password link
- Primary button
- Secondary link to register
- Optional side panel with a calm property image or brand message

Page 4 — Forgot Password Page
Include:
- Email field
- Simple instructions
- Button to send reset link/code
- Link back to login

Important design behavior:
- Auth pages must feel very easy, clean, and realistic
- Inputs should be soft and modern with clear labels
- Seller vs buyer role selection should be visually strong but simple
- No overdesigned auth illustrations
- Keep these pages easy to build
```


### Section 2 — Discovery + Search + Detail

```text
SECTION PROMPT — Dar+ / Property Discovery

Create a complete UI design section for Dar+ that includes these pages:
1. Explorer / Home Feed
2. Search Results / Filters Page
3. Property Detail Page
4. Saved / Favorites Page

Design intent:
This is the heart of buyer discovery. It should feel image-first, trustworthy, and easy to scan. The explorer and search should be clean and practical, while the property detail page should feel complete and professionally structured.

Page 1 — Explorer / Home Feed
Include:
- Top navigation with logo, search field, category dropdown, messages icon, saved icon, user avatar
- Optional filter chips under the top bar
- Main property feed in a clean card grid
- Listing cards with large cover image, price, location, property title, category badge, completion badge, and seller mini info
- Completion states like “Fully Documented” and “Needs More Details”
- Save/favorite action on cards
- Optional featured card / promoted card style
- Empty state or loading card example is a plus

Explorer card design:
- Photo-first
- Price and location clearly visible
- Completion quality badge integrated elegantly
- Professional and believable
- Not crowded

Page 2 — Search Results / Filters Page
Include:
- Larger search input at top
- Left sidebar filters on desktop
- Filters for category, city, price range, size in m², bedrooms, bathrooms, listing quality/completeness, media type, seller type
- Result count and sort dropdown
- Results grid using the same property cards
- Active filter chips above results
- Empty state design for no results

Filter design:
- Calm, structured, soft surfaces
- Sliders, checkboxes, pills, and dropdowns should all match the master style
- Make it look implementation-friendly and not overly custom

Page 3 — Property Detail Page
Include:
- Large image gallery with main image and thumbnails
- Optional short video thumbnail block
- Property title, price, city, and category
- Completion score or checklist summary near the top
- Structured “Property Information” section with key-value layout
- Sections for dimensions, rooms, floor, area, age, orientation, materials, amenities, etc.
- Dedicated “Required Photos” section labeled by room/space
- Description section
- Seller card with avatar, name, city, response rate or trust indicators, view profile button
- Main actions: Message Seller, Save, Share via WhatsApp
- Sticky action panel on desktop is a plus
- Optional map preview block

Property detail feeling:
- Very trustworthy
- Highly structured
- Clean visual grouping
- Feels more reliable than a casual marketplace listing
- Should clearly express Dar+’s value through the completeness system

Page 4 — Saved / Favorites Page
Include:
- Simple page header
- Grid of saved properties
- Filter or sort options
- Empty state with illustration or soft image block

Important design behavior:
- Keep the browsing experience calm and premium
- Property photos should do most of the visual work
- Interface should always support trust, clarity, and completeness
```


### Section 3 — Seller Posting Flow

```text
SECTION PROMPT — Dar+ / Seller Listing Creation

Create a complete UI design section for Dar+ that includes these pages:
1. Choose Property Category
2. Blueprint Form / Property Details Form
3. Media Upload Page
4. Review & Publish Page
5. Edit Listing Page

Design intent:
This is Dar+’s signature experience. It should feel guided, clear, and confidence-building. Sellers should feel that the app is helping them create a better listing step by step, not overwhelming them.

Shared design rules:
- Use a multi-step flow with a visible stepper at the top
- Labels like Step 1 of 4, Step 2 of 4, etc.
- Use progress and completion cues
- Make the experience feel simple and structured
- Avoid complex enterprise form design

Page 1 — Choose Property Category
Include:
- Header with title and short explanation
- Selectable category cards: Apartment, Villa, House, Land, Commercial
- Each category card should have icon, short description, and maybe a small example of what information/media will be required
- Primary continue button

Page 2 — Blueprint Form / Property Details
Include:
- Multi-section form layout
- Property basics: title, price, city, address, size, type
- Dynamic fields depending on category
- Example groups: rooms, bathrooms, floors, terrace, parking, building age, condition, orientation, furnished/unfurnished, construction material, finishing level
- Sidebar or top summary showing listing completion status
- Smart helper text explaining why detailed info improves trust
- Clean section cards inside the form

Page 3 — Media Upload Page
Include:
- Clearly labeled required upload slots by area/room
- Example labels: Facade, Living Room, Kitchen, Master Bedroom, Bathroom, Balcony, Staircase, Garden, Office Area, Land View, depending on category
- Separate required and optional media blocks
- Image upload cards with placeholder preview state
- Optional video upload area
- Completion progress showing how many required items are done
- Supportive helper note explaining that complete media makes listings more professional

Page 4 — Review & Publish
Include:
- Summary card of the listing
- Image preview strip
- Completion score widget
- Section showing any missing required elements
- Primary publish button
- Secondary edit buttons for each block
- Tone should reassure the seller before posting

Page 5 — Edit Listing
Include:
- Same general structure as create flow
- Status badges like Published, Draft, Sold
- Actions to update, mark as sold, archive, or delete
- Cleaner dashboard-like top bar for management

Important design behavior:
- This section must make Dar+’s blueprint concept visually obvious
- The design should communicate structure and trust, not bureaucracy
- The flow must feel buildable with standard cards, inputs, upload boxes, badges, and progress bars
```


### Section 4 — Profile + Messaging

```text
SECTION PROMPT — Dar+ / Profiles and Messaging

Create a complete UI design section for Dar+ that includes these pages:
1. My Profile / Seller Dashboard
2. Public Seller Profile
3. Inbox / Conversations List
4. Conversation / Chat Page

Design intent:
These pages should feel practical, clean, and familiar. Messaging should be simple and direct. Profiles should support trust and give enough seller context without becoming too social-media heavy.

Page 1 — My Profile / Seller Dashboard
Include:
- Seller cover area or clean profile header
- Avatar, full name, city, member since
- Stats row: active listings, sold listings, total views, saved count
- Tabs or segmented controls for Active Listings, Drafts, Sold
- Listings grid with edit/manage actions
- Button to create new listing
- Account settings shortcut
- Visual balance between profile identity and listing management

Page 2 — Public Seller Profile
Include:
- Similar profile header, more simplified
- Seller avatar, name, city, short bio or trust text
- Badges like Active Seller, Fully Documented Listings, Responsive
- Grid of active listings
- Message button
- Optional trust metrics like average response time or completion quality

Page 3 — Inbox / Conversations List
Include:
- Clean two-column messaging layout on desktop if possible
- Conversation list with avatar, property thumbnail, listing title, last message preview, timestamp, unread badge
- Search conversations field
- Filters like All, Unread, Buyers, Sellers if useful
- Calm, familiar chat list design

Page 4 — Conversation / Chat Page
Include:
- Header with user info and related property card or mini property preview
- Message bubbles left/right
- Date separators
- Input box with send button
- Optional attachment or property reference chip
- Sidebar or top mini listing context to remind users what property the chat is about

Important design behavior:
- Messaging should feel simple, human, and easy
- Profiles should build trust, not feel like social media vanity pages
- Keep everything soft and product-like
```


### Section 5 — Utility Pages

```text
SECTION PROMPT — Dar+ / Utility and Support Pages

Create a complete UI design section for Dar+ that includes these pages:
1. Notifications Page
2. 404 / Not Found Page
3. Empty States Collection
4. Basic Settings Page

Design intent:
These screens should complete the product and make it feel thought-through. They must stay simple, clean, and consistent with the rest of Dar+.

Page 1 — Notifications
Include:
- List of recent updates such as new messages, saved listing price changes, listing approved, listing needs more media, new inquiry received
- Clear read/unread states
- Soft status icons and timestamps

Page 2 — 404 / Not Found
Include:
- Friendly minimal error page
- Soft illustration or property-themed visual
- Button back to explorer
- Calm reassuring tone

Page 3 — Empty States Collection
Design empty states for:
- No saved properties
- No conversations
- No listings yet
- No search results
- No notifications
Each should use small illustration or image block, short message, and a clear CTA

Page 4 — Settings
Include:
- Profile settings
- Contact info
- Password/security
- Notification preferences
- Language placeholder
- Simple form sections in cards

Important design behavior:
- These pages should feel polished but lightweight
- No unnecessary complexity
- Make the product feel complete for presentation purposes
```


## Final Design Notes

Use this at the **end of every Stitch prompt**:

```text
FINAL DESIGN NOTES FOR STITCH

Please keep the final result practical, elegant, and implementation-friendly.

Critical rules:
- Light mode only
- Soft, warm, realistic UI
- Clean web app design, not a concept shot
- Use consistent spacing and reusable card patterns
- Keep components believable for a student-built React + Tailwind application
- Do not overdesign forms, charts, or interactions
- Avoid futuristic effects, neon, overly glassy cards, or hard-to-build visual tricks
- Avoid making the app feel like a luxury real-estate brand for millionaires only
- Avoid looking like a generic cheap classified marketplace
- Maintain a balance: premium but simple, creative but realistic

Preferred visual system:
- Warm off-white background
- White/ivory cards
- Teal primary buttons and active states
- Soft beige section surfaces
- Terracotta as a small accent only
- Large real-estate images
- Rounded cards
- Subtle shadows
- Thin soft borders
- Strong hierarchy and readable forms

Product personality:
Dar+ should feel like a trustworthy real-estate platform that improves the quality of listings through structure and clarity.

Build realism:
The UI should look like it can actually be developed in a short internship period.
Use repeated patterns smartly:
- same property card style
- same form card style
- same header/navigation logic
- same badge system
- same progress component style

Important concept to express visually:
Dar+ is not just for browsing properties.
Dar+ is about better property presentation through required media, structured details, and listing completeness.

Output expectation:
Generate polished, coherent UI screens for the requested section and its pages, all following the same design system and brand direction.
```

Would you like me next to turn this into a cleaner **copy-paste document format** with big section titles and separators so you can use it directly as your Dar+ design prompt file?
<span style="display:none">[^13][^14][^15][^16][^17][^18][^19][^20][^21][^22][^23][^24][^25][^26][^27][^28][^29][^30][^31][^32][^33][^34][^35]</span>

<div align="center">⁂</div>

[^1]: https://www.zillow.com/buy/app-download/

[^2]: https://apps.apple.com/us/app/zillow-real-estate-rentals/id310738695

[^3]: https://play.google.com/store/apps/details?id=com.zillow.android.zillowmap\&hl=en

[^4]: https://www.rightmove.co.uk/news/articles/property-news/rightmoves-new-version-of-the-iphone-app-has-arrived/

[^5]: https://apps.apple.com/fr/app/property-finder-real-estate/id897540233

[^6]: https://propertyindustryeye.com/rightmove-adds-video-tour-functionality-on-site-and-apps/

[^7]: https://www.houzz.com/photos/home-design-ideas-phbr0-bp~

[^8]: https://www.houzz.com/mobileApps

[^9]: https://www.behance.net/search/projects/real estate ui

[^10]: https://dribbble.com/tags/real-estate-app

[^11]: https://dribbble.com/tags/real-estate-mobile-app

[^12]: https://dribbble.com/tags/real-estate-app-design

[^13]: Alright-now-I-wanna-start-executing-the-plan-you.pdf

[^14]: Alright-now-I-wanna-start-executing-the-plan-you.pdf

[^15]: Alright-now-I-wanna-start-executing-the-plan-you.pdf

[^16]: Alright-now-I-wanna-start-executing-the-plan-you.pdf

[^17]: Alright-now-I-wanna-start-executing-the-plan-you.pdf

[^18]: https://www.zillow.com/news/about/

[^19]: https://miracuves.com/blog/zillow-app-features/

[^20]: https://oyelabs.com/zillow-new-features-to-add-to-your-real-estate-app/

[^21]: https://www.youtube.com/watch?v=0IuQkcAVdCg

[^22]: https://appinventiv.com/blog/cost-to-develop-real-estate-app-like-property-finder/

[^23]: https://www.zillow.help/article/mobile-choices-ipad-zd360000516847

[^24]: https://www.youtube.com/watch?v=r6LlXaDrMCo

[^25]: https://www.propertyfinder.com/news/property-finder-menas-leading-real-estate-platform-rolls-out-the-regions-first-home-valuation-feature-with-forward-looking-value-indicators/

[^26]: https://www.zillow.com/learn/home-comparison-tool-zillow-app/

[^27]: https://play.google.com/store/apps/details?id=com.houzz.app\&hl=en

[^28]: https://apps.apple.com/us/app/houzz-home-design-remodel/id399563465

[^29]: https://play.google.com/store/apps/details/Houzz_Home_Design_Remodel?id=com.houzz.app\&hl=en_ZA

[^30]: https://www.houzz.com

[^31]: https://www.behance.net/search/projects/real estate ui design

[^32]: https://dribbble.com/tags/houzz

[^33]: https://www.behance.net/search/projects/real estate ui ux

[^34]: https://www.instagram.com/popular/houzz-app-interior-inspiration/

[^35]: https://www.behance.net/search/projects/real estate

