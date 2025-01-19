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
// containerが存在する場合のみ描画
if (container) {
    // Reactコンポーネントの描画
    const root = createRoot(container);
    // AnimatedTitleコンポーネントの描画
    root.render(<AnimatedTitle />);
}