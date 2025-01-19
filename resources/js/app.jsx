import React from "react";
import { createRoot } from "react-dom/client";
import ExampleComponent from "./components/ExampleComponent";
import './bootstrap'; // Bootstrapのインポート
import Alpine from 'alpinejs'; // AlpineJSのインポート

// AlpineJSの初期化
window.Alpine = Alpine;
Alpine.start();

// Reactコンポーネントの描画
const container = document.getElementById("example");
if (container) {
    const root = createRoot(container);
    root.render(<ExampleComponent />);
}