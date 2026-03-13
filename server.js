require('dotenv').config();
const express = require('express');
const fetch = require('node-fetch');
const cors = require('cors');

const app = express();
const PORT = process.env.PORT || 3000;

const FB_PAGE_ID = process.env.FB_PAGE_ID;
const FB_ACCESS_TOKEN = process.env.FB_ACCESS_TOKEN;
const CACHE_TTL_MS = 15 * 60 * 1000; // 15 minut

let cache = { data: null, fetchedAt: 0 };

app.use(cors({ origin: process.env.ALLOWED_ORIGIN || '*' }));
app.use(express.static('.'));

// Pomocná funkce — rozdělení eventů na upcoming / past
function splitEvents(events) {
  const now = Date.now();
  const upcoming = [];
  const past = [];
  for (const ev of events) {
    const startTime = new Date(ev.start_time).getTime();
    if (startTime >= now) {
      upcoming.push(ev);
    } else {
      past.push(ev);
    }
  }
  // upcoming od nejbližšího, past od nejnovějšího
  upcoming.sort((a, b) => new Date(a.start_time) - new Date(b.start_time));
  past.sort((a, b) => new Date(b.start_time) - new Date(a.start_time));
  return { upcoming, past };
}

// GET /api/events
app.get('/api/events', async (req, res) => {
  if (!FB_PAGE_ID || !FB_ACCESS_TOKEN) {
    return res.status(500).json({
      error: 'Chybí FB_PAGE_ID nebo FB_ACCESS_TOKEN v .env souboru.'
    });
  }

  // Vrátit z cache pokud je čerstvá
  if (cache.data && Date.now() - cache.fetchedAt < CACHE_TTL_MS) {
    return res.json({ source: 'cache', ...cache.data });
  }

  try {
    const fields = 'id,name,description,start_time,end_time,place,cover,event_times,ticket_uri';
    const url =
      `https://graph.facebook.com/v19.0/${FB_PAGE_ID}/events` +
      `?fields=${fields}` +
      `&time_filter=upcoming` +
      `&limit=50` +
      `&access_token=${FB_ACCESS_TOKEN}`;

    const urlPast =
      `https://graph.facebook.com/v19.0/${FB_PAGE_ID}/events` +
      `?fields=${fields}` +
      `&time_filter=past` +
      `&limit=20` +
      `&access_token=${FB_ACCESS_TOKEN}`;

    const [resUpcoming, resPast] = await Promise.all([
      fetch(url),
      fetch(urlPast)
    ]);

    const dataUpcoming = await resUpcoming.json();
    const dataPast = await resPast.json();

    if (dataUpcoming.error) {
      return res.status(502).json({ error: dataUpcoming.error.message });
    }

    const result = {
      upcoming: dataUpcoming.data || [],
      past: dataPast.data || []
    };

    cache = { data: result, fetchedAt: Date.now() };
    return res.json({ source: 'live', ...result });

  } catch (err) {
    console.error('FB API chyba:', err);
    return res.status(502).json({ error: 'Nepodařilo se načíst eventy z Facebooku.' });
  }
});

// GET /api/health
app.get('/api/health', (_req, res) => res.json({ ok: true }));

app.listen(PORT, () => {
  console.log(`UFI DJ Portfolio server běží na http://localhost:${PORT}`);
});
