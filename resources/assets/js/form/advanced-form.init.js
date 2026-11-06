/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Advanced Form init js
*/

/* Basic Tagify */
var basicTagify = document.getElementById('basic-tagify');
new Tagify(basicTagify)
/* Basic Tagify */

/* Readonly Mix */
var readonlyMix = document.getElementById('readonly-mix')
new Tagify(readonlyMix);
/* Readonly Mix */

/* Tagify With Custom Suggestions */
var customDropdown = document.getElementById('custom-dropdown'),
  tagify = new Tagify(customDropdown, {
    whitelist: ["A# .NET", "A# (Axiom)", "A-0 System", "A+", "A++", "ABAP", "ABC", "ABC ALGOL", "ABSET", "ABSYS", "ACC", "Accent", "Ace DASL", "ACL2", "Avicsoft", "ACT-III", "Action!", "ActionScript", "Ada", "Adenine", "Agda", "Agilent VEE", "Agora", "AIMMS", "Alef", "ALF", "ALGOL 58", "ALGOL 60", "ALGOL 68", "ALGOL W", "Alice", "Alma-0", "AmbientTalk", "Amiga E", "AMOS", "AMPL", "Apex (Salesforce.com)", "APL", "AppleScript", "Arc", "ARexx", "Argus", "AspectJ", "Assembly language", "ATS", "Ateji PX", "AutoHotkey", "Autocoder", "AutoIt", "AutoLISP / Visual LISP", "Averest", "AWK", "Axum", "Active Server Pages", "ASP.NET", "B", "Babbage", "Bash", "BASIC", "bc", "BCPL", "BeanShell", "Batch (Windows/Dos)", "Bertrand", "BETA", "Bigwig", "Bistro", "BitC", "BLISS", "Blockly", "BlooP", "Blue", "Boo", "Boomerang", "Bourne shell (including bash and ksh)", "BREW", "BPEL", "B", "C--", "C++ – ISO/IEC 14882", "C# – ISO/IEC 23270", "C/AL", "Caché ObjectScript", "C Shell", "Caml", "Cayenne", "CDuce", "Cecil", "Cesil", "Céu", "Ceylon", "CFEngine", "CFML", "Cg", "Ch", "Chapel", "Charity", "Charm", "Chef", "CHILL", "CHIP-8", "chomski", "ChucK", "CICS", "Cilk", "Citrine (programming language)", "CL (IBM)", "Claire", "Clarion", "Clean", "Clipper", "CLIPS", "CLIST", "Clojure", "CLU", "CMS-2", "COBOL – ISO/IEC 1989", "CobolScript – COBOL Scripting language", "Cobra", "CODE", "CoffeeScript", "ColdFusion", "COMAL", "Combined Programming Language (CPL)", "COMIT", "Common Intermediate Language (CIL)", "Common Lisp (also known as CL)", "COMPASS", "Component Pascal", "Constraint Handling Rules (CHR)", "COMTRAN", "Converge", "Cool", "Coq", "Coral 66", "Corn", "CorVision", "COWSEL", "CPL", "CPL", "Cryptol", "csh", "Csound", "CSP", "CUDA", "Curl", "Curry", "Cybil", "Cyclone", "Cython", "Java", "Javascript", "M2001", "M4", "M#", "Machine code", "MAD (Michigan Algorithm Decoder)", "MAD/I", "Magik", "Magma", "make", "Maple", "MAPPER now part of BIS", "MARK-IV now VISION:BUILDER", "Mary", "MASM Microsoft Assembly x86", "MATH-MATIC", "Mathematica", "MATLAB", "Maxima (see also Macsyma)", "Max (Max Msp – Graphical Programming Environment)", "Maya (MEL)", "MDL", "Mercury", "Mesa", "Metafont", "Microcode", "MicroScript", "MIIS", "Milk (programming language)", "MIMIC", "Mirah", "Miranda", "MIVA Script", "ML", "Model 204", "Modelica", "Modula", "Modula-2", "Modula-3", "Mohol", "MOO", "Mortran", "Mouse", "MPD", "Mathcad", "MSIL – deprecated name for CIL", "MSL", "MUMPS", "Mystic Programming L"],
    maxTags: 10,
    dropdown: {
      maxItems: 5,
      enabled: 0,
      closeOnSelect: false
    }
  })
/* Tagify With Custom Suggestions */

/* Tagify Single-Value Select */
var input = document.querySelector('input[name=tags-select-mode]'),
  tagify = new Tagify(input, {
    enforceWhitelist: true,
    mode: "select",
    whitelist: ["first option", "second option", "third option"],
    blacklist: ['foo', 'bar'],
  })
/* Tagify Single-Value Select */

/* Tagify With Mix Text & Tags */
// Define two types of whitelists, each used for the dropdown suggestions menu,
// depending on the prefix pattern typed (@/#). See settings below.
var whitelist_1 = [
  { value: 100, text: 'kenny', title: 'Kenny McCormick' },
  { value: 200, text: 'cartman', title: 'Eric Cartman' },
  { value: 300, text: 'kyle', title: 'Kyle Broflovski' },
  { value: 400, text: 'token', title: 'Token Black' },
  { value: 500, text: 'jimmy', title: 'Jimmy Valmer' },
  { value: 600, text: 'butters', title: 'Butters Stotch' },
  { value: 700, text: 'stan', title: 'Stan Marsh' },
  { value: 800, text: 'randy', title: 'Randy Marsh' },
  { value: 900, text: 'Mr. Garrison', title: 'POTUS' },
  { value: 1000, text: 'Mr. Mackey', title: "M'Kay" }
]

// Second whitelist, which is shown only when starting to type "#".
// Below whitelist is the simplest possible format.
var whitelist_2 = ['Homer simpson', 'Marge simpson', 'Bart', 'Lisa', 'Maggie', 'Mr. Burns', 'Ned', 'Milhouse', 'Moe'];


// initialize Tagify
var input = document.querySelector('[name=mix]'),
  // init Tagify script on the above inputs
  tagify = new Tagify(input, {
    //  mixTagsInterpolator: ["{{", "}}"],
    mode: 'mix',  // <--  Enable mixed-content
    pattern: /@|#/,  // <--  Text starting with @ or # (if single, String can be used here)
    tagTextProp: 'text',  // <-- the default property (from whitelist item) for the text to be rendered in a tag element.
    // Array for initial interpolation, which allows only these tags to be used
    whitelist: whitelist_1.concat(whitelist_2).map(function (item) {
      return typeof item == 'string' ? { value: item } : item
    }),

    // custom validation - no special characters
    validate(data) {
      return !/[^a-zA-Z0-9 ]/.test(data.value)
    },

    dropdown: {
      enabled: 1,
      position: 'text', // <-- render the suggestions list next to the typed text ("caret")
      mapValueTo: 'text', // <-- similar to above "tagTextProp" setting, but for the dropdown items
      highlightFirst: true  // automatically highlights first sugegstion item in the dropdown
    },
    callbacks: {
      add: console.log,  // callback when adding a tag
      remove: console.log   // callback when removing a tag
    }
  })


// A good place to pull server suggestion list accoring to the prefix/value
tagify.on('input', function (e) {
  var prefix = e.detail.prefix;

  // first, clean the whitlist array, because the below code, while not, might be async,
  // therefore it should be up to you to decide WHEN to render the suggestions dropdown
  // tagify.settings.whitelist.length = 0;

  if (prefix) {
    if (prefix == '@')
      tagify.whitelist = whitelist_1;

    if (prefix == '#')
      tagify.whitelist = whitelist_2;

    if (e.detail.value.length > 1)
      tagify.dropdown.show(e.detail.value);
  }
})
/* Tagify With Mix Text & Tags */

// The DOM element you wish to replace with Tagify
var input = document.querySelector('input[name=rtl-example]');

// initialize Tagify on the above input node reference
new Tagify(input, {
  whitelist: [
    { value: "מיכאל כהן", full: "מיכאל כהן - פיתוח תוכנה מתקדם ויישום טכנולוגיות חדשניות בתחום התעשייה והייצור" },
    { value: "שרה לוי", full: "שרה לוי - ניהול ופיתוח פתרונות אקולוגיים וסביבתיים למתן יתרון תחרותי לעסקים" },
    { value: "אברהם גולן", full: "אברהם גולן - יישום ופיתוח טכנולוגיות מתקדמות לשיפור פרודוקטיביות ויצירתיות בארגונים" },
    { value: "רחל רביבו", full: "רחל רביבו - מחקר ופיתוח טכנולוגי בתחום החדשנות והיזמות לקידום עסקים ותעשיות" },
    { value: "דוד כהן", full: "דוד כהן - פיתוח ויישום טכנולוגיות מתקדמות לשיפור תשתיות מידע עסקיות" },
    { value: "רבקה אריאל", full: "רבקה אריאל - ייזום ופיתוח מוצרים חדשניים עבור תעשיות יצירתיות ומתקדמות" }
  ],
  dropdown: {
    mapValueTo: 'full',
    classname: 'tagify__dropdown--rtl-example',
    enabled: 0, // shows the suggestiosn dropdown once field is focused
    RTL: true,
    escapeHTML: false // allows HTML inside each suggestion item
  }
})

let defaultDualListElement = document.getElementById('defaultDualList');
if (defaultDualListElement) {
  let defaultDualList = new DualListbox('#defaultDualList', {
    addButtonText: 'Add',
    addAllButtonText: 'Add All',
    removeButtonText: 'Remove',
    removeAllButtonText: 'Remove All',
  });
}

let defaultEventListenersElement = document.getElementById('defaultDualList');
if (defaultEventListenersElement) {
  let defaultEventListeners = new DualListbox('#defaultEventListeners', {
    availableTitle: 'Available numbers',
    selectedTitle: 'Selected numbers',
    addButtonText: '>',
    removeButtonText: '>',
    addAllButtonText: '>>',
    removeAllButtonText: '>>',
    searchPlaceholder: 'search numbers'
  });
}
