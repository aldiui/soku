import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset, require("./vendor/wireui/wireui/tailwind.config.js")],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        "./vendor/wireui/wireui/src/*.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/WireUi/**/*.php",
        "./vendor/wireui/wireui/src/Components/**/*.php",
    ],
    theme: {
        // extend: {
        //     colors: {
        //         primary: colors.amber,
        //     },
        // },
    },
}
