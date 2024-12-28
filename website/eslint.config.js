import globals from "globals";
import pluginJs from "@eslint/js";
import pluginVue from "eslint-plugin-vue";


/** @type {import('eslint').Linter.Config[]} */
export default [
    {
        files: ["**/*.{js,mjs,cjs,vue}"],
        languageOptions: {
            globals: {
                ...globals.browser, // Browser-specific globals like `window`, `document`
                process: "readonly" // Add `process` as a readonly global
            },
        },
    },
    pluginJs.configs.recommended, // Recommended JavaScript rules
    ...pluginVue.configs["flat/essential"], // Essential Vue rules
];