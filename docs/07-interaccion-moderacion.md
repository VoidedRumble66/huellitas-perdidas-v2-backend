# 07 - Interacción y moderación

## Comentario vs avistamiento
- **Comentario**: interacción conversacional en una publicación (opiniones, preguntas, respuestas).
- **Avistamiento**: señal operativa de que alguien cree haber visto a la mascota y puede aportar contexto de lugar/tiempo/confianza.

Separarlos evita mezclar conversación general con evidencia potencialmente accionable.

## ¿Por qué `post_sightings` va en tabla separada?
Los avistamientos tienen atributos propios (`seen_at`, `confidence_level`, revisión por moderador, estado de confirmación) que no aplican a un comentario normal.

La separación ayuda a:
- filtrar por avistamientos confirmados,
- mantener trazabilidad de revisión,
- priorizar hallazgos relevantes.

## Reportes polimórficos
La tabla `reports` usa `reportable_type` + `reportable_id`, por lo que un mismo sistema de reporte sirve para:
- publicaciones,
- comentarios,
- avistamientos,
- usuarios.

Esto unifica reglas de revisión y simplifica expansión futura.

## Motivos de reporte y prevención de riesgo
El catálogo `report_reasons` estandariza clasificación de incidentes como:
- spam,
- información falsa,
- contenido duplicado,
- posible chantaje,
- intento de fraude o cobro sospechoso,
- acoso,
- datos personales expuestos.

Esta clasificación permite detectar patrones tempranos y priorizar casos críticos.

## `moderation_actions` como historial administrativo
Cada decisión de moderación queda registrada como evento auditable sobre un `target` polimórfico (post, comment, sighting, report o user).

Eso permite:
- trazabilidad de decisiones,
- análisis de reincidencia,
- transparencia interna del equipo moderador.

## Seguridad y confianza de la plataforma
La combinación de comentarios estructurados, avistamientos revisables, reportes polimórficos y acciones de moderación auditables fortalece la integridad del sistema y reduce riesgos de desinformación, duplicidad y extorsión en la comunidad.
