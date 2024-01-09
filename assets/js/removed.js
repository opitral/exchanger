// var currency = {
//   btc:     {value:false, long_name: "bitcoin",         short_name: "bitcoin",          min_limit: 0.00184, max_limit: 7.37559 },
//   eth:     {value:false, long_name: "ethereum",        short_name: "ethereum",         min_limit: 0.1, max_limit: 10 },
//   ftm:     {value:false, long_name: "fantom",          short_name: "fantom",           min_limit: 1, max_limit: 100 },
//   ltc:     {value:false, long_name: "litecoin",        short_name: "litecoin",         min_limit: 1, max_limit: 100 },
//   matic:   {value:false, long_name: "polygon",         short_name: "polygon",          min_limit: 1, max_limit: 100 },
//   shib:    {value:false, long_name: "shiba inu",       short_name: "shiba inu",        min_limit: 1, max_limit: 100 },
//   sol:     {value:false, long_name: "solana",          short_name: "solana",           min_limit: 1, max_limit: 100 },
//   trx:     {value:false, long_name: "tron",            short_name: "tron",             min_limit: 1, max_limit: 100 },
//   usdt:    {value:false, long_name: "tether",          short_name: "tether",           min_limit: 1, max_limit: 100 },
//   usdttrc: {value:false, long_name: "tether on tron",  short_name: "tether on tron",   min_limit: 1, max_limit: 100 },
//   xmr:     {value:false, long_name: "monero",          short_name: "monero",           min_limit: 1, max_limit: 100 },
//   xrp:     {value:false, long_name: "ripple",          short_name: "ripple",           min_limit: 1, max_limit: 100 },
//   xtz:     {value:false, long_name: "tezos",           short_name: "tezos",            min_limit: 1, max_limit: 100 },
//   zec:     {value:false, long_name: "zcash",           short_name: "zcash",            min_limit: 1, max_limit: 100 },
//   zrx:     {value:false, long_name: "0x" ,             short_name: "0x" ,              min_limit: 1, max_limit: 100 },
//   ada:     {value:false, long_name: "cardano",         short_name: "cardano",          min_limit: 1, max_limit: 100 },
//   bch:     {value:false, long_name: "bitcoin cash",    short_name: "bitcoin cash",     min_limit: 1, max_limit: 100 },
//   dash:    {value:false, long_name: "dash",            short_name: "dash",             min_limit: 1, max_limit: 100 },
//   doge:    {value:false, long_name: "dogecoin" ,       short_name: "dogecoin" ,        min_limit: 1, max_limit: 100 },
//   dot:     {value:false, long_name: "polkadot",        short_name: "polkadot",         min_limit: 1, max_limit: 100 },
//   etc:     {value:false, long_name: "ethereum classic",short_name: "ethereum-classic", min_limit: 1, max_limit: 100 },
// }





// const adrs = {
//   btc:     ["1"],
//   eth:     ["0x"],
//   ftm:     ["0x"],
//   ltc:     ["L", "M"],
//   matic:   ["0x"],
//   shib:    ["0x"],
//   sol:     ["5"],
//   trx:     ["T"],
//   usdt:    ["1"],
//   usdttrc: ["T"],
//   xmr:     ["4"],
//   xrp:     ["r"],
//   zec:     ["t1", "t3"],
//   zrx:     ["0x"],
//   dash:    ["X", "D"],
//   doge:    ["D"],
// };





 
// function hash(d) {
//   let e = d || 32,
//       a = "";
//   for (let b = 0; b < e; ++b) {
//       let c = Math.floor(62 * Math.random());
//       a += "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM".substring(c, c + 1)
//   }
//   return a
// }

// function blockRand() {
//   return Math.floor(Math.random() * 1000000).toString().padStart(6, "0");
// }

// for (let i = 1; i <= 5; i++) {
//   let keys = Object.keys(adrs)
//   let randKey = keys[Math.floor(Math.random() * keys.length)]

//   dt.transactions.push({
//     hash: hash(10).toLowerCase()+'...',
//     block: blockRand(),
//     from:'76B955...',
//     to:'BA965J...',
//     value:`609.52 ${randKey}`
//   })
// }





// function inpFunc(inp) {
//   const field = inp ? "receive" : "send"
//   const sv = currency[dt.choosed.send].value
//   const rv = currency[dt.choosed.receive].value
//   const max = currency[dt.choosed[field]].max_limit
//   const formatString = `0.${"0".repeat(cfg.aftComma)}`
//   const i = `inp${inp + 1}`

//   dt[i] = dt[i] > max ? max : dt[i] 

//   dt[inp ? "inp1" : "inp2"] = (+((!inp) ? (sv * dt[i] / rv) : ( rv * dt[i] / sv)) * cfg.plusPercent).toFixed(cfg.aftComma)

//   if (dt[inp] == formatString) dt[inp] = 0
// }
// function blurFunc(inp){
//   const field = inp ? "receive" : "send"
//   const sv = currency[dt.choosed.send].value
//   const rv = currency[dt.choosed.receive].value
//   const min = currency[dt.choosed[field]].min_limit
//   const max = currency[dt.choosed[field]].max_limit

//   const i = `inp${inp + 1}`

//   dt[i] = Math.min(Math.max(dt[i], min), max);

//   dt[inp ? "inp1" : "inp2"] = (+((!inp) ? (sv * dt[i] / rv) : (rv * dt[i] / sv)) * cfg.plusPercent).toFixed(cfg.aftComma);
// };









// function setChildEvent(a, b) {
//   for (const elem of a.querySelector(".container").children) {
//     elem.onclick = function () {
//       let prevVal1 = dt.choosed.send;
//       let prevVal2 = dt.choosed.receive;

//       dt.choosed[b] = this.querySelector("img")
//         .src.split("/")
//         .at(-1)
//         .split(".")[0]
//         .toLowerCase();

//       if (dt.choosed.send == dt.choosed.receive) {
//         dt.choosed.send = prevVal1;
//         dt.choosed.receive = prevVal2;

//         showAlert("Select different currencies",{bg:'#e84142'})
//       }
//       else {
//         getCryptoPrice()
//       }
//     };
//   }
// }

// setChildEvent(send, "send");
// setChildEvent(receive, "receive");





// const currencyLow = {};

// for (let key in currency) {
//   currencyLow[key.toLowerCase()] = currency[key];
// }

// currency = currencyLow