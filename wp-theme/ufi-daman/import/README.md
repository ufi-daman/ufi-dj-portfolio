# Import minulých akcí z Facebooku

Soubor `ufi-events-past.xml` obsahuje **30 velkých akcí**, kde UFI DA MAN hrál —
vytažené z Facebook exportu, s opraveným kódováním a odfiltrovanými akcemi,
kde byl jen host (koncerty jiných umělců, markety, foosball).

## Jak importovat

1. WP Admin → **Nástroje → Import**
2. U „WordPress" klikni **Instalovat** (pokud ještě nemáš), pak **Spustit importér**
3. Nahraj `ufi-events-past.xml`
4. U „Assign Authors" nech přiřazení na admina, **nezaškrtávej** „Download and import file attachments"
5. Klikni **Submit** → vytvoří se 30 eventů typu *Event* se statusem *past*

## Co import nastaví

Každá akce dostane: název, datum (pro řazení), rok, místo (`Venue · Praha`) a žánrový tag.
Vše je editovatelné ve **WP Admin → Events**.

## Poznámky

- Jedna akce (Nightlife v Centrále, 5. 9. 2026) je do budoucna → status *upcoming*.
- Rezidence ve Vinyl Baru / Kontrast Baru (59 týdenních nocí) nejsou zahrnuté —
  jsou to malé pravidelné akce, ne „velké". Lze doplnit na vyžádání.
- Import lze bezpečně vrátit: v Events označ nechtěné a dej do koše.
