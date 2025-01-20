import React from 'react';
import { motion } from 'framer-motion';

const AnimatedTitle = () => {
    return (
        <motion.div
            initial={{ opacity: 0, y: -50 }}  // 開始位置をより上に
            animate={{ opacity: 1, y: 0 }}    // 終了位置
            transition={{ 
                duration: 1.2,                // アニメーション時間を長く
                type: "spring",               // バネのような動き
                bounce: 0.3                   // バウンス効果
            }}
            className="w-full flex justify-center items-center"
        >
            <a href="/">
                <img 
                    src="/images/ogp.png" 
                    alt="転職マネージャー" 
                    className="h-20 w-auto"
                />
            </a>
        </motion.div>
    );
};

export default AnimatedTitle;