# 12 - Sistema visual base

## Objetivo
Definir una base visual reutilizable para Huellitas Perdidas v2, manteniendo identidad de marca, experiencia mobile-first y soporte para tema claro/oscuro en la versión web + PWA.

## Paleta oficial
- **Primario de marca:** `#F27F3E`.
- **Secundario estructural:** `#2C3E50`.
- **Acento lima:** `--color-accent-lime` (valor base actual `#B9D83D`).
- **Fondo base claro:** `#FAF8F5`.
- **Texto principal:** `#2B2B2B`.
- **Superficie:** `#FFFFFF`.

## Roles de color
- `--color-primary`: CTA principales, elementos de marca y foco visual.
- `--color-secondary`: footer, bloques de contraste, navegación y profundidad.
- `--color-accent-lime`: etiquetas, estados y acciones secundarias cortas.
- `--color-muted`: textos secundarios y contenido de apoyo.
- `--color-border`: separación visual suave para cards, inputs y secciones.

## Tema oscuro
- Activado por preferencia guardada del usuario o por `prefers-color-scheme`.
- Fondo oscuro elegante (`#1F252B`) y superficies (`#27323B`), evitando negro puro.
- El naranja de marca se conserva para continuidad de identidad.
- Toggle de tema en navbar con persistencia en `localStorage`.

## Tipografía base
- Stack recomendada: `Inter`, `Segoe UI`, `Roboto`, `system-ui`.
- Tamaños fluidos en títulos (`clamp`) y cuerpo legible para móvil.

## Componentes reutilizables
Definidos en `public/css/huellitas.css`:
- Botones: `btn-primary`, `btn-secondary`, `btn-outline`.
- Cards: `card`, variantes por estado (`status-lost`, `status-found`, `status-adoption`).
- Badges/chips: `chip`, `chip-lime`, `chip-warning`, `chip-danger`.
- Alertas: `alert`, `alert-info`.
- Formularios: `form-control` con foco visible.
- Layout utilitario: `container`, `section`, `grid-cards`.

## Fondos y superficies
- Fondo general: cálido y neutro para reducir fatiga visual.
- Superficies: blancas o elevadas con sombras suaves.
- Bordes sutiles para mantener estructura limpia y amigable.

## Iconografía
- Se usa una sola línea de íconos SVG coherente en navbar, acciones y footer.
- Redes sociales con formas reconocibles y consistentes (Facebook, WhatsApp, Instagram).
- Evitar mezclar estilos visuales incompatibles.

## Lineamientos para futuras pantallas
1. Reutilizar clases del sistema visual antes de crear estilos nuevos.
2. Mantener contraste AA mínimo en texto y acciones.
3. Priorizar interacción táctil (mínimo 44px en controles clave).
4. Mantener layouts mobile-first y escalar por breakpoints.
5. Evitar dependencias pesadas de UI sin necesidad del producto.
6. Conservar coherencia de marca en modo claro y oscuro.
