import React from "react";
import { createRoot } from "react-dom/client";
import AnimatedTitle from "./components/AnimatedTitle";
import './bootstrap'; // Bootstrapのインポート
import Alpine from 'alpinejs'; // AlpineJSのインポート

// AlpineJSの初期化
window.Alpine = Alpine;
Alpine.start();

// Reactコンポーネントの描画
const container = document.getElementById("animated-title");
if (container) {
    const root = createRoot(container);
    root.render(<AnimatedTitle />);
}