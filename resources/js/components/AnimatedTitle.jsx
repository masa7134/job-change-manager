import React from 'react';
import { motion } from 'framer-motion';

const AnimatedTitle = () => {
    return (
        <motion.div
            initial={{ opacity: 0, y: -20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
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