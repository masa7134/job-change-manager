import './bootstrap';
import React from "react";
import { createRoot } from "react-dom/client";
import AnimatedTitle from "./components/AnimatedTitle";
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

const container = document.getElementById("animated-title");
if (container) {
    const root = createRoot(container);
    root.render(<AnimatedTitle />);
}