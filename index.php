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
        const DEMO_LIVING = ["baby", "bear", "bird", "boar", "bush", "carp", "clam", "crab", "crow", "deer", "dove", "duck", "fawn", "fish", "foal", "frog", "gnat", "goat", "hare", "hawk", "lady", "lamb", "lion", "lynx", "mice", "mole", "moss", "moth", "mule", "newt", "pony", "puma", "seal", "slug", "swan", "toad", "tree", "wasp", "wolf", "worm"];
        const DEMO_NONLIVING = ["ball", "bath", "beer", "boat", "bowl", "camp", "coal", "coat", "cord", "dial", "disk", "drug", "farm", "film", "food", "fuel", "gift", "gold", "hill", "hole", "lake", "land", "loaf", "lock", "mast", "maze", "menu", "milk", "moon", "news", "path", "plug", "salt", "snow", "soil", "tank", "tool", "wall", "wine", "wood"];
        const BLOCK_LENGTH = 2; // Equal to 1 + number of desired trials per block (to account for final node)
        const BLOCKS = 1;

        // TRIAL BLOCKS
        var instructions_suppress = {
            type: 'instructions',
            pages: [
                '<p>In this task, a set of red and blue words will appear on the screen, like this:</p>' +
                "<br /><br /><center><table id='instructionTable' class='wordgrid'><col width='200px' /><col width='50px' /><col width='200px' /><tr><td><div class='colrd'>"+"rate"+"</div></td><td></td><td><div class='colbl'>"+"till"+"</div></td></tr><tr><td><div style='margin-bottom:80px;'>&nbsp;</div></td><td><div style='font-size:60px;'>+</div></td><td></td></tr><tr><td><div class='colbl'>"+"pool"+"</div></td><td></td><td><div class='colrd'>"+"tool"+"</div></td></tr></table></center>" +
                '<br /><br /><p>You need to remember all of the words and the color that they are written in.</p>',
                '<p>The word set will be followed by a cue telling you to keep remembering either the red or the blue words.</p><p>If the cue is REMEMBER READ, you should keep remembering the words "RATE" and "TOOL", because they were written in red in the word set before.</p><p>If the cue is REMEMBER BLUE, you should keep remembering the words "TILL" and "POOL", as they were written in blue in the word set before.</p>',
                '<p>After a pause, a test word (written in black ink) will appear:</p><br /><br /><h1>POOL</h1><br /><p>If the test word is one of the words you were supposed to attend to, press the Y key on your keyboard for <u>Y</u>es.</p><p>Otherwise, press the N key on your keyboard for <u>N</u>o.</p>',
                '<p>First, you will do some practice.</p><p>When you are ready to begin, press the <u>Next ></u> button below.</p><p>Otherwise, you may review the instructions using the <u>< Previous</u> button below.</p>'
                ],
            post_trial_gap: 2000,
            show_clickable_nav: true,
            allow_keys: false
        }

        // BUILD PROBE DISTRIBUTION
        var probe_list = [];
        var valid_distribution_total = Math.round(BLOCK_LENGTH * .4);
        var lure_distribution_total = Math.round(BLOCK_LENGTH * .3);
        var control_distribution_total = Math.round(BLOCK_LENGTH * .3);

            // validate probe distribution
            if(valid_distribution_total + lure_distribution_total + control_distribution_total != BLOCK_LENGTH) {
                while(valid_distribution_total + lure_distribution_total + control_distribution_total != BLOCK_LENGTH) {
                    if(valid_distribution_total + lure_distribution_total + control_distribution_total > BLOCK_LENGTH) {
                        random_delete_idx = jsPsych.randomization.sampleWithoutReplacement([0,1,2],1);
                        if(random_delete_idx == 0) { 
                            valid_distribution_total--; 
                        } else if(random_delete_idx == 1) { 
                            lure_distribution_total--; 
                        } else if(random_delete_idx == 2) { 
                            control_distribution_total--; 
                        }
                    } else if(valid_distribution_total + lure_distribution_total + control_distribution_total < BLOCK_LENGTH) {
                        random_add_idx = jsPsych.randomization.sampleWithoutReplacement([0,1,2],1);
                        if(random_add_idx == 0) { 
                            valid_distribution_total++; 
                        } else if(random_add_idx == 1) {
                            lure_distribution_total++; 
                        } else if(random_add_idx == 2) { 
                            control_distribution_total++; 
                        }
                    }
                }
            }

        for(var i = 0; i < (valid_distribution_total + lure_distribution_total + control_distribution_total); i++) {
            random_probe_idx = jsPsych.randomization.sampleWithoutReplacement([0,1,2],1);
            if(random_probe_idx == 0) { // Valid Probe Director
                probe_list.push(0); 
            } else if(random_probe_idx == 1) { // Lure Probe Director
                probe_list.push(1); 
            } else if(random_probe_idx == 2) { // Control Probe Director
                probe_list.push(2); 
            }
        }

        // BUILD EXPERIMENT
        var trials = [];
        var subject_id = jsPsych.randomization.randomID(15); // generate a random subject ID
        var trial_counter = 1;
        
    </script>
</html>