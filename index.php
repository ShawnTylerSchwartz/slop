<!-- Shawn T. Schwartz, 2020 -->
<!DOCTYPE html>
<html>
    <head>
        <script src="jsPsych/jspsych.js"></script>
        <script src="jsPsych/plugins/jspsych-image-keyboard-response.js"></script>
        <script src="jsPsych/plugins/jspsych-html-button-response.js"></script>
        <script src="jsPsych/plugins/jspsych-html-keyboard-response.js"></script>
        <script src="jsPsych/plugins/jspsych-instructions.js"></script>
        <link rel="stylesheet" href="jsPsych/css/jspsych.css">
        <style>
            img {
            width: 300px;
            }

            .wordgrid {
                table-layout: fixed !important; 
                white-space: nowrap !important;
            }

            .black {
                font-size: 50px; 
                font-weight: bold; 
                color: black; 
                text-transform: uppercase;
            }

            .colrd {
                font-size: 50px; 
                font-weight: bold; 
                color: red; 
                text-transform: uppercase;
            }

            .colbl {
                font-size: 50px; 
                font-weight: bold; 
                color: blue; 
                text-transform: uppercase;
            }

            #instructionTable td {
                text-align: center; 
                /* vertical-align: middle; */
            }
        </style>
    </head>

    <body>
    </body>

    <script>

        // CONSTANTS
        const LIVING = ["bird", "lamb", "tree", "cow", "plant", "dove", "horse", "owl", "fish", "bunny", "grass", "pig", "girl", "cat", "hawk", "frog", "adult", "queen", "nurse", "wife", "rat", "lice", "diver", "pet", "man", "kids", "woman", "wasp", "baby", "bride", "child", "beast", "dog", "puppy", "lion", "bees", "roach", "snake", "thief", "shark"];
        const NONLIVING = ["pizza", "ship", "cane", "bomb", "lamp", "tank", "bench", "quart", "bed", "key", "dirt", "door", "lake", "hat", "paint", "air", "bath", "book", "pie", "glass", "tool", "ship", "rock", "house", "candy", "flag", "radio", "wine", "lump", "ocean", "news", "beach", "mail", "debt", "gold", "wound", "plane", "car", "fire", "war"];
        const CONTROL = ["lazy", "quiet", "bored", "bland", "cozy", "slow", "pity", "shy", "rusty", "weary", "part", "safe", "wise", "blase", "phase", "tidy", "bless", "paint", "watch", "dump", "waste", "moody", "obey", "odd", "dark", "green", "nice", "blind", "cook", "kind", "dream", "pinch", "black", "rigid", "fall", "tune", "heal", "dirty", "kick", "foul", "gripe", "cut", "blond", "bake", "hard", "charm", "loyal", "cold", "greet", "rough", "learn", "good", "wink", "hope", "cute", "proud", "bold", "dead", "lost", "lie", "brave", "burn", "rude", "noisy", "toxic", "slap", "happy", "annoy", "tense", "lucky", "drown", "quick", "brutal", "power", "mad", "alert", "panic", "fight", "fun", "win"];
        
        
    </script>
</html>