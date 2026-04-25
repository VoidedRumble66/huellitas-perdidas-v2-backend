# 10 - Enfoque Web Responsive + PWA

## ¿Qué significa este enfoque en Huellitas Perdidas v2?
Huellitas Perdidas v2 iniciará como una plataforma web responsive (mobile-first) con capacidades de PWA instalable. Esto permite utilizar el sistema desde navegador y también instalarlo en el celular como acceso directo tipo app.

## ¿Por qué iniciar con PWA y no app móvil nativa?
La decisión busca acelerar la validación del producto y del flujo operativo con una única base tecnológica al inicio, manteniendo costos y complejidad bajo control.

## Ventajas para Huellitas Perdidas
- Menor costo de desarrollo inicial.
- Menor costo de mantenimiento.
- No requiere publicación inmediata en Play Store/App Store.
- Acceso inmediato desde navegador.
- Instalación como ícono en celulares compatibles.
- Una sola base de código para web y experiencia móvil inicial.
- Validación de negocio más rápida con ciclos cortos de mejora.

## Limitaciones iniciales
- No es una app nativa completa.
- Algunas capacidades dependen del navegador y del sistema operativo.
- Notificaciones push y offline avanzado pueden requerir configuración adicional futura.

## ¿Cómo se mantiene escalable?
- La lógica de negocio se organizará en **Actions/Services**.
- Los controladores web estarán separados de controladores API futuros.
- La base de datos se mantiene desacoplada de la capa visual.
- **Sanctum** permanece listo para una API futura consumible por app nativa o híbrida.
