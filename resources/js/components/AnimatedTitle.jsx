import React from 'react';
import { motion } from 'framer-motion';

const AnimatedTitle = () => {
    return (
        <motion.div
            initial={{ rotate: -18000, scale: 0 }}
            animate={{ rotate: 0, scale: 1 }}
            transition={{ duration: 3 }}
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