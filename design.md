# Design — 十八桥社区支持者门户 (BECSP)

A locked design system for this app. Every page redesign reads this file before emitting code. Do not regenerate per page — extend or amend this file when the system needs to grow.

## Genre
playful — community / friendly / warm-soft register. Soft surfaces, hover-responsive motion, friendlier card edges, warm cream paper.

## Macrostructure family

- **Marketing/landing pages (home):** Marquee Hero — the primary action (NFC card read) fills the fold as a bold statement. Below the fold: support plans, community links, serial API hint. Use H1 Marquee hero archetype.
- **Result/app pages (card detail):** Stat-Led — the card verification result is the data moment. Giant status indicator, info rows as supporting stats, links grid below. Use H4 Stat-Led hero archetype.
- **Redirect page (card-rd.php):** minimal interstitial — spinner + auto-post form. No structural redesign needed; inherit tokens only.

## Theme — custom (warm-community)

Anchored on the community's burgundy red (`#a70034`) with coral-pink secondary (`#ed556a`), riding Hum's foundation: warm cream paper, rounded surfaces, mandatory motion, Satoshi display face.

```css
:root {
  --color-paper:       oklch(97% 0.008 40);
  --color-paper-2:     oklch(93% 0.012 40);
  --color-paper-3:     oklch(88% 0.015 42);
  --color-paper-card:  oklch(99% 0.004 40);
  --color-rule:        oklch(82% 0.010 40);
  --color-neutral:     oklch(56% 0.008 40);
  --color-muted:       oklch(40% 0.008 35);
  --color-ink:         oklch(16% 0.012 35);
  --color-ink-2:       oklch(36% 0.010 35);
  --color-accent:      #a70034;
  --color-accent-ink:  oklch(98% 0.003 40);
  --color-accent-warm: #ed556a;
  --color-focus:       oklch(55% 0.17 22);
  --color-success:     oklch(58% 0.16 155);
  --color-error:       oklch(55% 0.17 22);
}
```

## Typography

- **Display:** "Satoshi", "PingFang SC", "Microsoft YaHei", system-ui, sans-serif — weight 700 for heads, 500 for subheads
- **Body:** "PingFang SC", "Microsoft YaHei", system-ui, sans-serif — weight 400
- **Wordmark/outlier:** "Bricolage Grotesque", "PingFang SC", "Microsoft YaHei", sans-serif — weight 700, only on the wordmark + hero stat
- **Mono:** "Geist Mono", ui-monospace, monospace — card numbers, UIDs, code
- Display tracking: -0.02em
- Type scale anchor: --text-display = clamp(2.75rem, 5vw + 1rem, 5.25rem)

```css
:root {
  --font-display:  "Satoshi", "PingFang SC", "Microsoft YaHei", system-ui, sans-serif;
  --font-body:     "PingFang SC", "Microsoft YaHei", system-ui, sans-serif;
  --font-wordmark: "Bricolage Grotesque", "PingFang SC", "Microsoft YaHei", sans-serif;
  --font-outlier:  "Geist Mono", ui-monospace, monospace;

  --text-xs:   0.64rem;
  --text-sm:   0.8rem;
  --text-base: 1rem;
  --text-md:   1.25rem;
  --text-lg:   1.5625rem;
  --text-xl:   1.9531rem;
  --text-2xl:  2.4414rem;
  --text-3xl:  3.0518rem;
  --text-display: clamp(2.25rem, 4.5vw + 0.5rem, 4rem);
}
```

## Spacing

4-point named scale. Pages must use named tokens (`var(--space-md)`), never raw values.

```css
:root {
  --space-3xs: 0.125rem;
  --space-2xs: 0.25rem;
  --space-xs:  0.5rem;
  --space-sm:  0.75rem;
  --space-md:  1rem;
  --space-lg:  1.5rem;
  --space-xl:  2.5rem;
  --space-2xl: 4rem;
  --space-3xl: 6rem;
}
```

## Motion

- Easings: `--ease-out: cubic-bezier(0.16, 1, 0.3, 1)`, `--ease-in: cubic-bezier(0.7, 0, 0.84, 0)`, `--ease-in-out: cubic-bezier(0.65, 0, 0.35, 1)`
- Duration scale: 1.1× (playful — slightly relaxed)
- Default-on primitives: CTA hover-lift, card hover-lift, one stagger reveal per page
- Reduced-motion: opacity-only crossfade ≤ 150 ms
- Spring on primary CTA only: `cubic-bezier(0.34, 1.56, 0.64, 0.98)` — Hum canonical

```css
:root {
  --ease-out:    cubic-bezier(0.16, 1, 0.3, 1);
  --ease-in:     cubic-bezier(0.7, 0, 0.84, 0);
  --ease-in-out: cubic-bezier(0.65, 0, 0.35, 1);
  --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 0.98);
  --dur-micro:   130ms;
  --dur-short:   240ms;
  --dur-long:    460ms;
}
```

## Microinteractions stance

- Silent success (no celebratory toasts)
- Hover lift on cards: `translateY(-3px)` + shadow expansion, 240 ms `--ease-out`
- Hover lift on primary CTA: `translateY(-2px)` + shadow expansion, 240 ms `--ease-spring`
- Focus rings: 2 px, `--color-focus`, instant appearance on `:focus-visible`
- Toast: slide-in 400 ms, dwell 4 s, slide-out 300 ms. Errors only.

## CTA voice

- Primary CTA: filled, rounded pill (999 px radius), warm gradient (`--color-accent` → `--color-accent-warm`), weight 600
- Secondary CTA: outlined, same radius, `--color-accent` border, transparent fill → tinted hover
- Link: underline on hover via `text-decoration-thickness: from-font`, accent colour

## Nav — N9 Edge-aligned minimal

Wordmark hard-left, single callout hard-right, vast empty space between. No link row. The absence is the design.

## Footer — Ft5 Statement

One large display sentence dominates — a closing line. Wordmark + copyright + licence sit beneath in muted small type.

## Per-page allowances

- Home (Marquee Hero): typography-only hero. No enrichment. Card grid for support plans. Hover-lift on cards.
- Card detail (Stat-Led): verification status as hero stat. Info rows as supporting stats. Links grid below.
- Card redirect: minimal interstitial. Inherits tokens only.

## What pages MUST share

- The wordmark in Bricolage Grotesque
- The accent colour and its placement (≤ 5% per viewport)
- The display + body + outlier font families
- The CTA voice (rounded pill, gradient fill)
- Section heading rhythm (single-column stacked head + body)
- No eyebrows. No numbered sections. No left-margin labels.

## What pages MAY differ on

- Macrostructure (Marquee Hero vs Stat-Led per page type)
- Hero archetype (H1 Marquee vs H4 Stat-Led)
- Enrichment — none (typography only for this app)
