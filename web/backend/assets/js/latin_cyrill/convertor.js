/**
 * Created by dilshod on 06.03.17.
 */

var retranslit = Papa.parse(retranslit_words);
var rcount = retranslit.data.length;

var rl_words = [];
var rc_words = [];
for(var i = 0; i < rcount; i++) {
    rl_words[i] = retranslit.data[i][0];
    rc_words[i] = retranslit.data[i][1];
}


function replaceArray(text,a1,a2) {
    for(var i = 0; i < a1.length; i++) {
        var pat = new RegExp(a1[i], "g");
        text = text.replace(pat, a2[i]);
    }
    return text;
}

function replaceWordArray(text,a1,a2) {
    for(var i = 0; i < a1.length; i++) {
        var wrapped = "\\b"+a1[i];
        var pat = new RegExp(wrapped, "g");
        text = text.replace(pat, a2[i]);
    }
    return text;
}

function latin2cyrill(text) {
    var text = text.replace(/G’|G'|G`|G‘/g,"Ғ");
    var text = text.replace(/g’|g'|g`|g‘/g,"ғ");
    var text = text.replace(/O’|O'|O`|O‘/g,"Ў");
    var text = text.replace(/o’|o'|o`|o‘/g,"ў");

    var text = text.replace(/'|`|‘/g,"’");
    var text = text.replace(/\bMЎJ/g,"\bМЎЪЖ");
    var text = text.replace(/\bMўj/g,"\bМўъж");
    var text = text.replace(/\bmўj/g,"\bмўъж");
    var text = text.replace(/\bMЎT/g,"\bМЎЪТ");
    var text = text.replace(/\bMўt/g,"\bМўът");
    var text = text.replace(/\bmўt/g,"\bмўът");

    var text = text.replace(/“([^“”]+)”/g, '«$1»');
    var text = text.replace(/"([^"]+)"/g, '«$1»');
    var text = text.replace(/-da\b/g, "dа");
    var text = text.replace(/-ku\b/g, "ku");
    var text = text.replace(/-chi\b/g, "chi");
    var text = text.replace(/-yu\b/g, "yu");
    var text = text.replace(/-u\b/g, "u");
    var text = text.replace(/(\b[0-9]+)-([^\s+])/g, "$1 $2");

    var text = replaceArray(text, l_ts, c_ts);
    var text = replaceWordArray(text, rl_words, rc_words);	//so'zma-so'z o'girish

    var text = text.replace(/\’([A-Z])/g, "Ъ$1");
    var text = text.replace(/\’([a-z])/g, "ъ$1");
    var text = replaceArray(text, l_letters_l2c, c_letters_l2c);

    var text = text.replace(/^E|([^БВГДЕЁЖЗИЙКЛМНПРСТФХЦЧШЪЫЬЭЮЯЎҚҒҲбвгдеёжзийклмнпрстфхцчшъыьэюяўқғҳ])E|([\s+])E/g, "$1$2Э");
    var text = text.replace(/^e|([^БВГДЕЁЖЗИЙКЛМНПРСТФХЦЧШЪЫЬЭЮЯЎҚҒҲбвгдеёжзийклмнпрстфхцчшъыьэюяўқғҳ])e|([\s+])e/g, "$1$2э");
    var text = text.replace(/e/g, "е");
    var text = text.replace(/([аоу])эв/g, "$1ев");
    var text = text.replace(/([АаОоУу])ЭВ/g, "$1ЕВ");

    var text = text.replace(/(\s)миль([^\w])|\wмиль([^\w])|^миль([^\w])/g, "$1мил$2$3");

    return text;
}

function cyrill2latin(text) {
    var text = replaceWordArray(text, rc_words, rl_words);	//so'zma-so'z o'girish
    var text = text.replace(/"([^"]*)"/g, '“$1”')	//qo'shtirnoqlarni
    var text = text.replace(/«([]*)»/g, '“$1”')			//o'girish

    var text = replaceArray(text, c_letters_c2l, l_letters_c2l);	//harfma-harf o'girish

    var text = text.replace(/([A-Z])Ё|Ё([A-Z])/g, "$1YO$2");	//Ё (YO)
    var text = text.replace(/Ё([a-z])|Ё(\s+)|Ё/g, "Yo$1$2");		//harfi uchun qoidalar

    var text = text.replace(/([A-Z])Ч|Ч([A-Z])/g, "$1CH$2");	//Ч (CH)
    var text = text.replace(/Ч([a-z])|Ч(\s+)|Ч/g, "Ch$1$2");		//harfi uchun qoidalar

    var text = text.replace(/([A-Z])Ш|Ш([A-Z])/g, "$1SH$2");	//Ш (SH)
    var text = text.replace(/Ш([a-z])|Ш(\s+)|Ш/g, "Sh$1$2");		//harfi uchun qoidalar

    var text = text.replace(/([A-Z])Ю|Ю([A-Z])/g, "$1YU$2");	//Ю (YU)
    var text = text.replace(/Ю([a-z])|Ю(\s+)|Ю/g, "Yu$1$2");		//harfi uchun qoidalar

    var text = text.replace(/([A-Z])Я|Я([A-Z])/g, "$1YA$2");	//Я (YA)
    var text = text.replace(/Я([a-z])|Я(\s+)|Я/g, "Ya$1$2");		//harfi uchun qoidalar

    var text = text.replace(/([AOUEI])Ц([A-Z])|([AOUEI])Ц(Е)/g, "$1$3TS$2$4");	//Ц (ЕҚ)
    var text = text.replace(/([aouei])ц([a-z])|([aouei])ц(е)/g, "$1$3ts$2$4");		//harfi uchun qoidalar
    var text = text.replace(/Ц/g, "S");
    var text = text.replace(/ц/g, "s");

    var text = text.replace(/([^\w])Е([A-Z])|([AOUEI])Е([A-Z])|^Е([A-Z])/g, "$1$3YE$2$4$5");
    var text = text.replace(/([^\w])Е([a-z])|([^\w])Е([^\w])|^Е([a-z])|^Е([^\w])|([^\w])Е/g, "$1$3$7Ye$2$4$5$6");
    var text = text.replace(/^е|([^\w])е|([aouei])е/g, "$1$2ye");
    var text = text.replace(/е/g, "e");

    return text;
}


$(function(){

    $('body').on("click",'#latin2cyrill', function () {
        var text = $('.latin-text').val();
        $('.cyrill-text').val(latin2cyrill(text));
    });


    $('body').on("click", '#cyrill2latin', function () {
        var text = $('.cyrill-text').val();
        $('.latin-text').val(cyrill2latin(text));
    });

});
