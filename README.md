# Mono Archive — WordPress Theme

A minimalist, high-end editorial WordPress theme designed for curators. Stark black-and-white aesthetic with a specific mechanism for identifying color photography.

## Features

- **Editorial Bento Grid** — Asymmetric photo grid homepage with 7 distinct layout slots
- **Photo Metadata** — Custom fields for Capture Date, Equipment, Settings, Location, Series, and Exposure
- **Color Recognition** — Every post tagged as "Color" gets a red status indicator dot; B&W posts get a neutral tag
- **Design System** — Monochromatic palette (#000, #FFF, #F9F9F9) with Inter typography
- **Responsive** — Mobile-first design with elegant desktop layouts
- **Accessible** — Skip links, ARIA labels, focus states, and semantic HTML

## Installation

1. Download or clone this repository
2. Upload the `mono-archive-theme` folder to `/wp-content/themes/`
3. Activate the theme in **Appearance → Themes**
4. Set up your navigation in **Appearance → Menus** (Primary Navigation)
5. Create posts with featured images and fill in the Photo Details meta box

## Custom Fields

Each post has a **Photo Details** meta box with:

| Field | Description | Example |
|-------|-------------|---------|
| Capture Date | When the photo was taken | OCT 24, 2023 |
| Equipment | Camera and lens | LEICA M11 · 35MM |
| Camera Settings | Aperture, shutter, ISO | F/2.8 · 1/500 · ISO 100 |
| Location | Where it was shot | REYKJAVÍK, ISL |
| Series | Series name | Series 04 |
| Plate Number | Plate identifier | Plate 12 |
| Exposure EV | Exposure value | +0.15 EV |
| Image Type | Color or Black & White | Color / B&W |

## Page Templates

- **Homepage** (`index.php`) — Asymmetric bento grid with editorial header
- **Single Post** (`single.php`) — Full photo detail with EXIF metadata
- **Archive** (`archive.php`) — Vertical list with thumbnails and pagination
- **About & Contact** (`page-about-contact.php`) — Split-screen layout with contact form
- **Search** (`search.php`) — Search results in archive style
- **404** (`404.php`) — Minimal editorial error page

## Design Credits

Design system: "Mono Archive" — The Digital Curator
Typography: Inter by Rasmus Andersson
Icons: Material Symbols Outlined by Google

## License

GNU General Public License v2 or later
