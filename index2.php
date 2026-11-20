<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>گیم پلازا - خانه بازی‌های ساده</title>
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎮</text></svg>">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;600;800;900&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#0a0e1a; --bg2:#131a2e; --card:#1a2138; --border:#2a3458;
  --accent:#00f0ff; --accent2:#ff2bd6; --accent3:#ffd60a;
  --text:#e8ecff; --muted:#8a92b8;
}
*{box-sizing:border-box}
body{font-family:'Vazirmatn',sans-serif;background:var(--bg);color:var(--text);margin:0;min-height:100vh}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(circle at 15% 20%,rgba(0,240,255,.08),transparent 40%),radial-gradient(circle at 85% 80%,rgba(255,43,214,.08),transparent 40%);pointer-events:none;z-index:0}
.game-card{background:linear-gradient(135deg,var(--card),var(--bg2));border:1px solid var(--border);border-radius:16px;transition:all .3s;overflow:hidden;position:relative;cursor:pointer}
.game-card:hover{transform:translateY(-6px);border-color:var(--accent);box-shadow:0 12px 30px -10px rgba(0,240,255,.3)}
.cat-pill{padding:8px 16px;border-radius:20px;border:1px solid var(--border);cursor:pointer;transition:all .2s;background:var(--card);white-space:nowrap;font-size:14px}
.cat-pill:hover{border-color:var(--accent)}
.cat-pill.active{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#000;border-color:transparent;font-weight:700}
.modal-overlay{position:fixed;inset:0;background:rgba(5,8,16,.85);backdrop-filter:blur(8px);z-index:50;display:none;align-items:flex-start;justify-content:center;padding:16px;overflow-y:auto}
.modal-overlay.active{display:flex}
.modal-box{background:linear-gradient(135deg,var(--bg2),var(--card));border:1px solid var(--border);border-radius:20px;max-width:600px;width:100%;margin:auto;box-shadow:0 20px 60px rgba(0,0,0,.5)}
.btn-glow{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#000;font-weight:700;border:none;border-radius:12px;padding:10px 20px;cursor:pointer;transition:all .2s;font-family:inherit}
.btn-glow:hover{transform:scale(1.05);box-shadow:0 0 20px rgba(0,240,255,.4)}
.btn-ghost{background:var(--card);color:var(--text);border:1px solid var(--border);border-radius:12px;padding:10px 18px;cursor:pointer;transition:all .2s;font-family:inherit}
.btn-ghost:hover{border-color:var(--accent);color:var(--accent)}
.cell{width:80px;height:80px;background:var(--card);border:2px solid var(--border);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:42px;font-weight:900;cursor:pointer;transition:all .2s}
.cell:hover{background:#232b48}
.cell.x{color:var(--accent)}.cell.o{color:var(--accent2)}
.mem-card{aspect-ratio:1;perspective:600px;cursor:pointer}
.mem-card-inner{position:relative;width:100%;height:100%;transition:transform .5s;transform-style:preserve-3d}
.mem-card.flipped .mem-card-inner{transform:rotateY(180deg)}
.mem-face{position:absolute;inset:0;backface-visibility:hidden;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:32px}
.mem-front{background:linear-gradient(135deg,var(--card),#232b48);border:1px solid var(--border)}
.mem-back{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#000;transform:rotateY(180deg);font-weight:900}
canvas{display:block;border-radius:12px;background:#0a0e1a;max-width:100%;height:auto}
@keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-5px)}75%{transform:translateX(5px)}}
.shake{animation:shake .3s}
.toast{position:fixed;top:20px;left:50%;transform:translateX(-50%) translateY(-20px);background:linear-gradient(135deg,var(--accent),var(--accent2));color:#000;padding:12px 24px;border-radius:12px;font-weight:700;z-index:100;opacity:0;pointer-events:none;transition:all .3s}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
::-webkit-scrollbar{width:8px;height:8px}
::-webkit-scrollbar-track{background:var(--bg)}
::-webkit-scrollbar-thumb{background:var(--border);border-radius:4px}
.game-icon{font-size:40px;filter:drop-shadow(0 0 8px rgba(0,240,255,.3))}
.glow-text{background:linear-gradient(135deg,var(--accent),var(--accent2),var(--accent3));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.scroll-x{overflow-x:auto;scrollbar-width:none}
.scroll-x::-webkit-scrollbar{display:none}
.sm-btn{border:none;cursor:pointer;transition:all .15s}
.sm-btn:active{transform:scale(.93)}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
.float{animation:float 3s ease-in-out infinite}
</style>
</head>
<body>
<div class="relative z-10 min-h-screen">
  <header class="sticky top-0 z-30 backdrop-blur-lg" style="background:rgba(10,14,26,.85);border-bottom:1px solid var(--border)">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="text-3xl float">🎮</div>
        <div>
          <h1 class="text-xl font-extrabold glow-text">گیم پلازا</h1>
          <p class="text-xs" style="color:var(--muted)">۲۴ بازی ساده و سرگرم‌کننده</p>
        </div>
      </div>
      <div class="text-sm" style="color:var(--muted)"><span id="game-count">۰</span> بازی</div>
    </div>
  </header>
  <div class="sticky top-[57px] z-20 backdrop-blur border-b" style="background:rgba(10,14,26,.9);border-color:var(--border)">
    <div class="max-w-7xl mx-auto px-4 py-3 scroll-x">
      <div id="categories" class="flex gap-2 min-w-max"></div>
    </div>
  </div>
  <main class="max-w-7xl mx-auto px-4 py-6">
    <div id="games-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4"></div>
  </main>
  <footer class="text-center py-8 text-sm" style="color:var(--muted)">ساخته شده با ❤️ - گیم پلازا | تمام بازی‌ها آفلاین اجرا می‌شوند</footer>
</div>
<div id="modal" class="modal-overlay">
  <div class="modal-box">
    <div class="flex items-center justify-between p-4 border-b sticky top-0 z-10" style="border-color:var(--border);background:var(--bg2)">
      <div><h2 id="modal-title" class="text-lg font-bold"></h2><p id="modal-desc" class="text-xs" style="color:var(--muted)"></p></div>
      <button id="modal-close" class="btn-ghost">بستن ✕</button>
    </div>
    <div id="game-container" class="p-6" dir="ltr"></div>
  </div>
</div>
<div id="toast" class="toast"></div>

<script>
function toFa(n){return String(n).replace(/\d/g,d=>'۰۱۲۳۴۵۶۷۸۹'[d])}
function showToast(msg){const t=document.getElementById('toast');t.textContent=msg;t.classList.add('show');setTimeout(()=>t.classList.remove('show'),2500)}

// ============ 1. TIC TAC TOE ============
function tictactoeInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-4 text-xl font-bold">نوبت شما</div><div class="grid grid-cols-3 gap-2 mx-auto w-max" id="tt-board"></div><button class="btn-glow mt-4" id="tt-reset">شروع مجدد</button></div>`;
  let board=Array(9).fill(''),over=false;
  const be=c.querySelector('#tt-board'),se=c.querySelector('div');
  const wins=[[0,1,2],[3,4,5],[6,7,8],[0,3,6],[1,4,7],[2,5,8],[0,4,8],[2,4,6]];
  const win=(b,p)=>wins.some(w=>w.every(i=>b[i]===p));
  function render(){be.innerHTML='';board.forEach((v,i)=>{const cell=document.createElement('div');cell.className='cell '+(v==='X'?'x':v==='O'?'o':'');cell.textContent=v;cell.onclick=()=>play(i);be.appendChild(cell)})}
  function play(i){if(over||board[i])return;board[i]='X';render();if(win(board,'X')){se.textContent='بردیدید! 🎉';over=true;return}if(!board.includes('')){se.textContent='مساوی!';over=true;return}setTimeout(()=>{let m=-1;for(let j=0;j<9;j++)if(!board[j]){const t=[...board];t[j]='O';if(win(t,'O')){m=j;break}}if(m===-1)for(let j=0;j<9;j++)if(!board[j]){const t=[...board];t[j]='X';if(win(t,'X')){m=j;break}}if(m===-1&&!board[4])m=4;if(m===-1){const e=board.map((v,i)=>v?null:i).filter(v=>v!==null);m=e[Math.floor(Math.random()*e.length)]}board[m]='O';render();if(win(board,'O')){se.textContent='کامپیوتر برد! 🤖';over=true;return}if(!board.includes('')){se.textContent='مساوی!';over=true;return}se.textContent='نوبت شما'},400)}
  c.querySelector('#tt-reset').onclick=()=>{board=Array(9).fill('');over=false;se.textContent='نوبت شما';render()};
  render();return null
}

// ============ 2. MEMORY MATCH ============
function memoryInit(c){
  const emojis=['🎮','🎯','🎨','🎲','🎵','🚀','⚡','🔥'];
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg">حرکت: <span id="mm-moves">۰</span> | جفت: <span id="mm-pairs">۰</span>/۸</div><div class="grid grid-cols-4 gap-2 mx-auto" style="max-width:360px" id="mm-board"></div><button class="btn-glow mt-4" id="mm-reset">شروع مجدد</button></div>`;
  let cards=[...emojis,...emojis].sort(()=>Math.random()-.5),flipped=[],matched=[],moves=0;
  const board=c.querySelector('#mm-board');
  function render(){board.innerHTML='';cards.forEach((emoji,i)=>{const card=document.createElement('div');card.className='mem-card'+(flipped.includes(i)||matched.includes(i)?' flipped':'');card.innerHTML=`<div class="mem-card-inner"><div class="mem-face mem-front">؟</div><div class="mem-face mem-back">${emoji}</div></div>`;card.onclick=()=>flip(i);board.appendChild(card)})}
  function flip(i){if(flipped.length>=2||flipped.includes(i)||matched.includes(i))return;flipped.push(i);render();if(flipped.length===2){moves++;c.querySelector('#mm-moves').textContent=toFa(moves);const[a,b]=flipped;if(cards[a]===cards[b]){matched.push(a,b);flipped=[];c.querySelector('#mm-pairs').textContent=toFa(matched.length/2);if(matched.length===cards.length)showToast('برنده شدید! 🎉');render()}else setTimeout(()=>{flipped=[];render()},800)}}
  c.querySelector('#mm-reset').onclick=()=>{cards=[...emojis,...emojis].sort(()=>Math.random()-.5);flipped=[];matched=[];moves=0;c.querySelector('#mm-moves').textContent='۰';c.querySelector('#mm-pairs').textContent='۰';render()};
  render();return null
}

// ============ 3. SNAKE ============
function snakeInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-2 text-lg">امتیاز: <span id="sn-score">۰</span></div><canvas id="sn-canvas" width="400" height="400" class="mx-auto"></canvas><div class="mt-3 text-sm" style="color:var(--muted)">کلیدهای جهت‌نما یا دکمه‌ها</div><div class="grid grid-cols-3 gap-1 max-w-[180px] mx-auto mt-3 md:hidden"><div></div><button data-d="up" class="btn-ghost">▲</button><div></div><button data-d="left" class="btn-ghost">◀</button><button data-d="down" class="btn-ghost">▼</button><button data-d="right" class="btn-ghost">▶</button></div><button class="btn-glow mt-3" id="sn-start">شروع</button></div>`;
  const canvas=c.querySelector('#sn-canvas'),ctx=canvas.getContext('2d');
  let snake=[{x:10,y:10}],dir={x:1,y:0},food={x:15,y:15},score=0,game=null,speed=120;
  const grid=20,cell=canvas.width/grid;
  function draw(){ctx.fillStyle='#0a0e1a';ctx.fillRect(0,0,canvas.width,canvas.height);ctx.fillStyle='#ff2bd6';ctx.beginPath();ctx.arc(food.x*cell+cell/2,food.y*cell+cell/2,cell/2-2,0,Math.PI*2);ctx.fill();snake.forEach((s,i)=>{ctx.fillStyle=i===0?'#00f0ff':`hsl(${190+i*4},80%,${60-i*.3}%)`;ctx.fillRect(s.x*cell+1,s.y*cell+1,cell-2,cell-2)})}
  function step(){const head={x:snake[0].x+dir.x,y:snake[0].y+dir.y};if(head.x<0||head.x>=grid||head.y<0||head.y>=grid||snake.some(s=>s.x===head.x&&s.y===head.y)){clearInterval(game);game=null;showToast(`بازی تمام! امتیاز: ${score}`);return}snake.unshift(head);if(head.x===food.x&&head.y===food.y){score++;c.querySelector('#sn-score').textContent=toFa(score);food={x:Math.floor(Math.random()*grid),y:Math.floor(Math.random()*grid)};if(speed>60){speed-=2;clearInterval(game);game=setInterval(step,speed)}}else snake.pop();draw()}
  function setDir(d){const dirs={up:{x:0,y:-1},down:{x:0,y:1},left:{x:-1,y:0},right:{x:1,y:0}};const nd=dirs[d];if(nd.x!==-dir.x||nd.y!==-dir.y)dir=nd}
  const kh=e=>{const m={ArrowUp:'up',ArrowDown:'down',ArrowLeft:'left',ArrowRight:'right'};if(m[e.key]){e.preventDefault();setDir(m[e.key])}};
  document.addEventListener('keydown',kh);
  c.querySelectorAll('[data-d]').forEach(b=>b.onclick=()=>setDir(b.dataset.d));
  c.querySelector('#sn-start').onclick=()=>{snake=[{x:10,y:10}];dir={x:1,y:0};score=0;speed=120;c.querySelector('#sn-score').textContent='۰';food={x:15,y:15};clearInterval(game);game=setInterval(step,speed);draw()};
  draw();return()=>{clearInterval(game);document.removeEventListener('keydown',kh)}
}

// ============ 4. WHACK-A-MOLE ============
function whackInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg">امتیاز: <span id="wh-score">۰</span> | زمان: <span id="wh-time">۳۰</span></div><div class="grid grid-cols-3 gap-2 mx-auto" style="max-width:300px" id="wh-board"></div><button class="btn-glow mt-4" id="wh-start">شروع</button></div>`;
  const board=c.querySelector('#wh-board');
  for(let i=0;i<9;i++){const hole=document.createElement('div');hole.className='aspect-square rounded-xl flex items-center justify-center text-4xl cursor-pointer select-none';hole.style.background='#1a2138';hole.style.border='2px solid var(--border)';hole.textContent='🕳️';hole.onclick=()=>{if(hole.textContent==='🐭'){score++;c.querySelector('#wh-score').textContent=toFa(score);hole.textContent='💥';setTimeout(()=>hole.textContent='🕳️',200)}};board.appendChild(hole)}
  let score=0,time=30,timer=null,moleTimer=null;
  function start(){score=0;time=30;c.querySelector('#wh-score').textContent='۰';c.querySelector('#wh-time').textContent='۳۰';clearInterval(timer);clearInterval(moleTimer);timer=setInterval(()=>{time--;c.querySelector('#wh-time').textContent=toFa(time);if(time<=0){clearInterval(timer);clearInterval(moleTimer);board.querySelectorAll('div').forEach(h=>h.textContent='🕳️');showToast(`پایان! امتیاز: ${score}`)}},1000);moleTimer=setInterval(()=>{board.querySelectorAll('div').forEach(h=>h.textContent='🕳️');board.children[Math.floor(Math.random()*9)].textContent='🐭'},800)}
  c.querySelector('#wh-start').onclick=start;
  return()=>{clearInterval(timer);clearInterval(moleTimer)}
}

// ============ 5. ROCK PAPER SCISSORS ============
function rpsInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-4 text-sm" style="color:var(--muted)">شما: <span id="rps-y">۰</span> | کامپیوتر: <span id="rps-c">۰</span></div><div class="text-2xl mb-4 min-h-[40px]" id="rps-result">یکی را انتخاب کنید</div><div class="flex gap-3 justify-center"><button data-c="rock" class="btn-ghost text-5xl p-6">✊</button><button data-c="paper" class="btn-ghost text-5xl p-6">✋</button><button data-c="scissors" class="btn-ghost text-5xl p-6">✌️</button></div><button class="btn-ghost mt-4" id="rps-reset">ریست</button></div>`;
  let y=0,comp=0;const choices=['rock','paper','scissors'],names={rock:'سنگ',paper:'کاغذ',scissors:'قیچی'};
  const result=c.querySelector('#rps-result');
  function play(choice){const ai=choices[Math.floor(Math.random()*3)];let r;if(choice===ai)r='مساوی! 🤝';else if((choice==='rock'&&ai==='scissors')||(choice==='paper'&&ai==='rock')||(choice==='scissors'&&ai==='paper')){r='بردیدید! 🎉';y++}else{r='باختید! 😢';comp++}result.innerHTML=`شما ${names[choice]} - کامپیوتر ${names[ai]}<br>${r}`;c.querySelector('#rps-y').textContent=toFa(y);c.querySelector('#rps-c').textContent=toFa(comp)}
  c.querySelectorAll('[data-c]').forEach(b=>b.onclick=()=>play(b.dataset.c));
  c.querySelector('#rps-reset').onclick=()=>{y=0;comp=0;result.textContent='یکی را انتخاب کنید';c.querySelector('#rps-y').textContent='۰';c.querySelector('#rps-c').textContent='۰'};
  return null
}

// ============ 6. HANGMAN ============
function hangmanInit(c){
  const words=['شیر','ببر','پلنگ','گوزن','خرگوش','مورچه','عقاب','کبوتر','دلفین','مار','فیل','زرافه','خفاش','میمون','سوسمار','پنگوئن','کرگدن'];
  const letters='ابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهی'.split('');
  let word,guessed,wrong;const max=6;
  const stages=['🙂','😐','🙁','😕','😟','😵'];
  c.innerHTML='<div id="hm-content"></div>';
  function newGame(){word=words[Math.floor(Math.random()*words.length)];guessed=new Set();wrong=0;render()}
  function render(){const display=[...word].map(ch=>guessed.has(ch)?ch:'＿').join(' ');const won=[...word].every(ch=>guessed.has(ch));const lost=wrong>=max;let msg=won?'برنده شدید! 🎉':lost?`باختید! کلمه: ${word}`:'';c.querySelector('#hm-content').innerHTML=`<div class="text-center"><div class="text-6xl mb-2">${lost?'💀':won?'🏆':stages[Math.min(wrong,5)]}</div><div class="text-xs mb-1" style="color:var(--muted)">اشتباه: <span style="color:#ff4466">${toFa(wrong)}/${toFa(max)}</span></div><div class="text-3xl font-bold my-3 tracking-widest">${display}</div><div class="text-lg mb-3 ${won?'text-green-400':lost?'text-red-400':''}" style="color:${won?'#00ff88':lost?'#ff4466':'var(--muted)'}">${msg}</div><div class="grid grid-cols-8 gap-1 max-w-md mx-auto">${letters.map(l=>`<button class="btn-ghost p-2 text-sm ${guessed.has(l)||won||lost?'opacity-30':''}" data-l="${l}">${l}</button>`).join('')}</div><button class="btn-glow mt-4" id="hm-new">کلمه جدید</button></div>`;c.querySelectorAll('[data-l]').forEach(b=>b.onclick=()=>{if(guessed.has(b.dataset.l)||won||lost)return;guessed.add(b.dataset.l);if(!word.includes(b.dataset.l))wrong++;render()});c.querySelector('#hm-new').onclick=newGame}
  newGame();return null
}

// ============ 7. 2048 ============
function game2048Init(c){
  c.innerHTML=`<div class="text-center"><div class="mb-2 text-lg">امتیاز: <span id="g-score">۰</span></div><div class="grid grid-cols-4 gap-2 mx-auto" style="width:max-content" id="g-board"></div><div class="mt-2 text-sm" style="color:var(--muted)">کلیدهای جهت‌نما یا دکمه‌ها</div><div class="grid grid-cols-3 gap-1 max-w-[180px] mx-auto mt-2 md:hidden"><div></div><button data-d="up" class="btn-ghost">▲</button><div></div><button data-d="left" class="btn-ghost">◀</button><button data-d="down" class="btn-ghost">▼</button><button data-d="right" class="btn-ghost">▶</button></div><button class="btn-glow mt-3" id="g-reset">شروع مجدد</button></div>`;
  let board,score;
  function init(){board=Array(16).fill(0);score=0;addTile();addTile();render()}
  function addTile(){const e=board.map((v,i)=>v?null:i).filter(v=>v!==null);if(e.length)board[e[Math.floor(Math.random()*e.length)]]=Math.random()<.9?2:4}
  function render(){const be=c.querySelector('#g-board');be.innerHTML='';const colors={0:'#1a2138',2:'#2a3458',4:'#3a4478',8:'#00f0ff',16:'#00d0e0',32:'#ff2bd6',64:'#ff0b99',128:'#ffd60a',256:'#ff8c00',512:'#00ff88',1024:'#9d00ff',2048:'#ff0040'};board.forEach(v=>{const cell=document.createElement('div');cell.className='w-16 h-16 sm:w-20 sm:h-20 rounded-lg flex items-center justify-center font-bold text-2xl';cell.style.background=colors[v]||'#fff';cell.style.color=v>4&&v<128?'#000':'#fff';cell.textContent=v||'';if(v>999)cell.style.fontSize='20px';be.appendChild(cell)});c.querySelector('#g-score').textContent=toFa(score)}
  function move(dir){let moved=false;for(let i=0;i<4;i++){let line;if(dir==='left')line=[board[i*4],board[i*4+1],board[i*4+2],board[i*4+3]];else if(dir==='right')line=[board[i*4+3],board[i*4+2],board[i*4+1],board[i*4+0]];else if(dir==='up')line=[board[i],board[i+4],board[i+8],board[i+12]];else line=[board[i+12],board[i+8],board[i+4],board[i]];const f=line.filter(v=>v);for(let j=0;j<f.length-1;j++)if(f[j]===f[j+1]){f[j]*=2;score+=f[j];f.splice(j+1,1)}while(f.length<4)f.push(0);for(let j=0;j<4;j++){let idx;if(dir==='left')idx=i*4+j;else if(dir==='right')idx=i*4+(3-j);else if(dir==='up')idx=j*4+i;else idx=(3-j)*4+i;if(board[idx]!==f[j])moved=true;board[idx]=f[j]}}if(moved){addTile();render()}if(!board.includes(0)&&!canMove())showToast('بازی تمام!')}
  function canMove(){for(let i=0;i<4;i++)for(let j=0;j<4;j++){const v=board[i*4+j];if(j<3&&v===board[i*4+j+1])return true;if(i<3&&v===board[(i+1)*4+j])return true}return false}
  const kh=e=>{const m={ArrowUp:'up',ArrowDown:'down',ArrowLeft:'left',ArrowRight:'right'};if(m[e.key]){e.preventDefault();move(m[e.key])}};
  document.addEventListener('keydown',kh);
  c.querySelectorAll('[data-d]').forEach(b=>b.onclick=()=>move(b.dataset.d));
  c.querySelector('#g-reset').onclick=init;init();
  return()=>document.removeEventListener('keydown',kh)
}

// ============ 8. MINESWEEPER ============
function minesInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-2 text-lg">مین: <span id="mn-mines">۱۰</span> | پرچم: <span id="mn-flags">۰</span></div><div class="grid grid-cols-9 gap-[2px] mx-auto" style="width:max-content" id="mn-board"></div><div class="mt-3 text-lg" id="mn-msg"></div><button class="btn-glow mt-3" id="mn-reset">شروع مجدد</button><div class="text-xs mt-2" style="color:var(--muted)">کلیک: باز کردن | راست‌کلیک: پرچم</div></div>`;
  const SIZE=9,MINES=10;let board,revealed,flagged,over;
  function init(){board=Array(SIZE*SIZE).fill(0);revealed=Array(SIZE*SIZE).fill(false);flagged=Array(SIZE*SIZE).fill(false);over=false;let p=0;while(p<MINES){const i=Math.floor(Math.random()*SIZE*SIZE);if(board[i]!==-1){board[i]=-1;p++}}for(let i=0;i<SIZE*SIZE;i++){if(board[i]===-1)continue;const x=i%SIZE,y=Math.floor(i/SIZE);let n=0;for(let dx=-1;dx<=1;dx++)for(let dy=-1;dy<=1;dy++){const nx=x+dx,ny=y+dy;if(nx>=0&&nx<SIZE&&ny>=0&&ny<SIZE&&board[ny*SIZE+nx]===-1)n++}board[i]=n}render()}
  function render(){const be=c.querySelector('#mn-board');be.innerHTML='';const colors=['','#00f0ff','#00ff88','#ffd60a','#ff8c00','#ff2bd6','#9d00ff','#fff','#aaa'];for(let i=0;i<SIZE*SIZE;i++){const cell=document.createElement('div');cell.className='w-8 h-8 rounded flex items-center justify-center font-bold text-sm cursor-pointer select-none';if(revealed[i]){cell.style.background=board[i]===-1?'#ff0040':'#1a2138';if(board[i]===-1)cell.textContent='💣';else if(board[i]>0){cell.textContent=board[i];cell.style.color=colors[board[i]]}}else{cell.style.background='#2a3458';if(flagged[i])cell.textContent='🚩'}cell.onclick=()=>{if(!over&&!flagged[i])reveal(i)};cell.oncontextmenu=e=>{e.preventDefault();if(!over&&!revealed[i]){flagged[i]=!flagged[i];c.querySelector('#mn-flags').textContent=toFa(flagged.filter(v=>v).length);render()}};be.appendChild(cell)}}
  function reveal(i){if(revealed[i])return;revealed[i]=true;if(board[i]===-1){over=true;c.querySelector('#mn-msg').textContent='باختید! 💥';board.forEach((v,j)=>{if(v===-1)revealed[j]=true});render();return}if(board[i]===0){const x=i%SIZE,y=Math.floor(i/SIZE);for(let dx=-1;dx<=1;dx++)for(let dy=-1;dy<=1;dy++){const nx=x+dx,ny=y+dy;if(nx>=0&&nx<SIZE&&ny>=0&&ny<SIZE)reveal(ny*SIZE+nx)}}const safe=board.filter(v=>v!==-1).length;if(revealed.filter(v=>v).length===safe){over=true;c.querySelector('#mn-msg').textContent='برنده شدید! 🎉'}render()}
  c.querySelector('#mn-reset').onclick=()=>{c.querySelector('#mn-msg').textContent='';init()};init();return null
}

// ============ 9. PONG ============
function pongInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-2 text-lg">شما: <span id="pn-p">۰</span> | کامپیوتر: <span id="pn-c">۰</span></div><canvas id="pn-canvas" width="400" height="300" class="mx-auto"></canvas><div class="text-sm mt-2" style="color:var(--muted)">ماوس را حرکت دهید</div><button class="btn-glow mt-2" id="pn-start">شروع</button></div>`;
  const canvas=c.querySelector('#pn-canvas'),ctx=canvas.getContext('2d');
  let py=130,cy=130,bx=200,by=150,vx=4,vy=3,ps=0,cs=0,running=false;
  function reset(){bx=200;by=150;vx=Math.random()>.5?4:-4;vy=(Math.random()-.5)*6}
  function loop(){if(!running)return;ctx.fillStyle='#0a0e1a';ctx.fillRect(0,0,canvas.width,canvas.height);ctx.fillStyle='#2a3458';for(let y=0;y<canvas.height;y+=20)ctx.fillRect(199,y,2,10);ctx.fillStyle='#00f0ff';ctx.fillRect(10,py-30,8,60);ctx.fillStyle='#ff2bd6';ctx.fillRect(382,cy-30,8,60);ctx.fillStyle='#ffd60a';ctx.beginPath();ctx.arc(bx,by,6,0,Math.PI*2);ctx.fill();bx+=vx;by+=vy;if(by<6||by>294)vy=-vy;if(bx<24&&by>py-30&&by<py+30){vx=Math.abs(vx);vy+=(by-py)*.1}if(bx>376&&by>cy-30&&by<cy+30){vx=-Math.abs(vx);vy+=(by-cy)*.1}cy+=(by-cy)*.08;cy=Math.max(30,Math.min(270,cy));if(bx<0){cs++;c.querySelector('#pn-c').textContent=toFa(cs);reset()}if(bx>400){ps++;c.querySelector('#pn-p').textContent=toFa(ps);reset()}requestAnimationFrame(loop)}
  canvas.addEventListener('mousemove',e=>{const rect=canvas.getBoundingClientRect();py=(e.clientY-rect.top)*(canvas.height/rect.height);py=Math.max(30,Math.min(270,py))});
  c.querySelector('#pn-start').onclick=()=>{if(!running){running=true;reset();loop();c.querySelector('#pn-start').textContent='توقف'}else{running=false;c.querySelector('#pn-start').textContent='ادامه'}};
  return()=>running=false
}

// ============ 10. BREAKOUT ============
function breakoutInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-2 text-lg">امتیاز: <span id="br-score">۰</span> | جان: <span id="br-lives">۳</span></div><canvas id="br-canvas" width="400" height="400" class="mx-auto"></canvas><div class="text-sm mt-2" style="color:var(--muted)">ماوس را حرکت دهید</div><button class="btn-glow mt-2" id="br-start">شروع</button></div>`;
  const canvas=c.querySelector('#br-canvas'),ctx=canvas.getContext('2d');
  let px=160,bx=200,by=300,vx=3,vy=-3,score=0,lives=3,running=false,bricks=[];
  function initBricks(){bricks=[];for(let r=0;r<5;r++)for(let col=0;col<8;col++)bricks.push({x:col*48+8,y:r*20+20,alive:true,color:['#ff2bd6','#ff8c00','#ffd60a','#00ff88','#00f0ff'][r]})}
  function loop(){if(!running)return;ctx.fillStyle='#0a0e1a';ctx.fillRect(0,0,400,400);bricks.forEach(b=>{if(b.alive){ctx.fillStyle=b.color;ctx.fillRect(b.x,b.y,44,16)}});ctx.fillStyle='#00f0ff';ctx.fillRect(px,380,80,10);ctx.fillStyle='#ffd60a';ctx.beginPath();ctx.arc(bx,by,6,0,Math.PI*2);ctx.fill();bx+=vx;by+=vy;if(bx<6||bx>394)vx=-vx;if(by<6)vy=-vy;if(by>380&&bx>px&&bx<px+80){vy=-Math.abs(vy);vx+=(bx-px-40)*.05}bricks.forEach(b=>{if(b.alive&&bx>b.x&&bx<b.x+44&&by>b.y&&by<b.y+16){b.alive=false;vy=-vy;score++;c.querySelector('#br-score').textContent=toFa(score)}});if(by>400){lives--;c.querySelector('#br-lives').textContent=toFa(lives);if(lives<=0){running=false;showToast('بازی تمام!')}else{bx=200;by=300;vx=3;vy=-3}}if(bricks.every(b=>!b.alive)){initBricks();bx=200;by=300;showToast('مرحله بعد! 🎉')}requestAnimationFrame(loop)}
  canvas.addEventListener('mousemove',e=>{const rect=canvas.getBoundingClientRect();px=(e.clientX-rect.left)*(400/rect.width)-40;px=Math.max(0,Math.min(320,px))});
  c.querySelector('#br-start').onclick=()=>{score=0;lives=3;bx=200;by=300;vx=3;vy=-3;c.querySelector('#br-score').textContent='۰';c.querySelector('#br-lives').textContent='۳';initBricks();running=true;loop()};
  return()=>running=false
}

// ============ 11. FLAPPY ============
function flappyInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-2 text-lg">امتیاز: <span id="fp-score">۰</span></div><canvas id="fp-canvas" width="300" height="400" class="mx-auto"></canvas><div class="text-sm mt-2" style="color:var(--muted)">کلیک یا فاصله برای پرش</div><button class="btn-glow mt-2" id="fp-start">شروع</button></div>`;
  const canvas=c.querySelector('#fp-canvas'),ctx=canvas.getContext('2d');
  let y=200,vy=0,pipes=[],score=0,running=false,frame=0;
  function reset(){y=200;vy=0;pipes=[];score=0;frame=0;c.querySelector('#fp-score').textContent='۰'}
  function loop(){if(!running)return;frame++;ctx.fillStyle='#0a0e1a';ctx.fillRect(0,0,300,400);ctx.fillStyle='#00ff88';pipes.forEach(p=>{ctx.fillRect(p.x,0,40,p.top);ctx.fillRect(p.x,p.top+100,40,400-p.top-100)});ctx.fillStyle='#ffd60a';ctx.beginPath();ctx.arc(50,y,12,0,Math.PI*2);ctx.fill();vy+=.4;y+=vy;if(frame%90===0)pipes.push({x:300,top:40+Math.random()*200});pipes.forEach(p=>p.x-=2);pipes=pipes.filter(p=>p.x>-40);if(y<0||y>400){running=false;showToast(`پایان! امتیاز: ${score}`);return}pipes.forEach(p=>{if(p.x<62&&p.x>38&&(y<p.top||y>p.top+100)){running=false;showToast(`پایان! امتیاز: ${score}`)}if(p.x===50){score++;c.querySelector('#fp-score').textContent=toFa(score)}});requestAnimationFrame(loop)}
  function jump(){if(running)vy=-7}
  canvas.onclick=jump;
  const kh=e=>{if(e.key===' '){e.preventDefault();jump()}};
  document.addEventListener('keydown',kh);
  c.querySelector('#fp-start').onclick=()=>{reset();running=true;loop()};
  return()=>{running=false;document.removeEventListener('keydown',kh)}
}

// ============ 12. SIMON ============
function simonInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg" id="sm-status">شروع کنید</div><div class="mb-3" id="sm-score">سطح: ۰</div><div class="grid grid-cols-2 gap-2 mx-auto" style="width:280px;height:280px"><button data-c="0" class="sm-btn rounded-tl-xl" style="background:#1a6e3c"></button><button data-c="1" class="sm-btn rounded-tr-xl" style="background:#8b1a1a"></button><button data-c="2" class="sm-btn rounded-bl-xl" style="background:#c9a227"></button><button data-c="3" class="sm-btn rounded-br-xl" style="background:#1a4d8b"></button></div><button class="btn-glow mt-4" id="sm-start">شروع</button></div>`;
  let seq=[],input=[],level=0,active=false;const colors=['#00ff88','#ff2bd6','#ffd60a','#00f0ff'],dim=['#1a6e3c','#8b1a1a','#c9a227','#1a4d8b'];
  const status=c.querySelector('#sm-status'),scoreEl=c.querySelector('#sm-score'),btns=c.querySelectorAll('.sm-btn');
  function flash(i){btns[i].style.background=colors[i];setTimeout(()=>btns[i].style.background=dim[i],300)}
  async function playSeq(){active=false;status.textContent='توجه کنید...';for(const s of seq){await new Promise(r=>setTimeout(r,600));flash(s)}active=true;input=[];status.textContent='نوبت شما'}
  function next(){level++;scoreEl.textContent=`سطح: ${toFa(level)}`;seq.push(Math.floor(Math.random()*4));playSeq()}
  function click(i){if(!active)return;flash(i);input.push(i);if(input[input.length-1]!==seq[input.length-1]){status.textContent=`باختید! سطح: ${toFa(level)}`;active=false;return}if(input.length===seq.length){status.textContent='درست! 🎉';active=false;setTimeout(next,800)}}
  btns.forEach(b=>b.onclick=()=>click(+b.dataset.c));
  c.querySelector('#sm-start').onclick=()=>{seq=[];level=0;scoreEl.textContent='سطح: ۰';next()};
  return null
}

// ============ 13. CONNECT FOUR ============
function connect4Init(c){
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg" id="c4-status">نوبت شما (صورتی)</div><div class="grid grid-cols-7 gap-1 mx-auto" style="width:max-content" id="c4-board"></div><button class="btn-glow mt-4" id="c4-reset">شروع مجدد</button></div>`;
  const ROWS=6,COLS=7;let board,over,turn;const status=c.querySelector('#c4-status');
  function init(){board=Array(ROWS*COLS).fill(0);over=false;turn=1;status.textContent='نوبت شما (صورتی)';render()}
  function render(){const be=c.querySelector('#c4-board');be.innerHTML='';for(let r=0;r<ROWS;r++)for(let col=0;col<COLS;col++){const cell=document.createElement('div');cell.className='w-10 h-10 rounded-full cursor-pointer';const v=board[r*COLS+col];cell.style.background=v===0?'#0a0e1a':v===1?'#ff2bd6':'#ffd60a';cell.style.border='2px solid var(--border)';cell.onclick=()=>drop(col);be.appendChild(cell)}}
  function drop(col){if(over||turn!==1)return;for(let r=ROWS-1;r>=0;r--)if(board[r*COLS+col]===0){board[r*COLS+col]=1;render();checkWin(1);if(!over)ai();return}}
  function checkWinSilent(p){for(let r=0;r<ROWS;r++)for(let col=0;col<COLS;col++){if(board[r*COLS+col]!==p)continue;const dirs=[[0,1],[1,0],[1,1],[1,-1]];for(const[dr,dc] of dirs){let n=0;for(let k=0;k<4;k++){const nr=r+dr*k,nc=col+dc*k;if(nr>=0&&nr<ROWS&&nc>=0&&nc<COLS&&board[nr*COLS+nc]===p)n++;else break}if(n===4)return true}}return false}
  function checkWin(p){if(checkWinSilent(p)){status.textContent=p===1?'برنده شدید! 🎉':'کامپیوتر برد! 🤖';over=true;return true}return false}
  function ai(){if(over)return;turn=2;status.textContent='فکر کردن...';setTimeout(()=>{let move=-1;for(let col=0;col<COLS;col++)for(let r=ROWS-1;r>=0;r--)if(board[r*COLS+col]===0){board[r*COLS+col]=2;if(checkWinSilent(2)){move=col;board[r*COLS+col]=0;break}board[r*COLS+col]=0}if(move===-1)for(let col=0;col<COLS;col++)for(let r=ROWS-1;r>=0;r--)if(board[r*COLS+col]===0){board[r*COLS+col]=1;if(checkWinSilent(1)){move=col;board[r*COLS+col]=0;break}board[r*COLS+col]=0}if(move===-1)move=Math.floor(Math.random()*COLS);for(let r=ROWS-1;r>=0;r--)if(board[r*COLS+move]===0){board[r*COLS+move]=2;break}render();checkWin(2);if(!over){turn=1;status.textContent='نوبت شما'}},500)}
  c.querySelector('#c4-reset').onclick=init;init();return null
}

// ============ 14. SLIDING PUZZLE ============
function slideInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg">حرکت: <span id="sl-moves">۰</span></div><div class="grid grid-cols-4 gap-1 mx-auto" style="width:max-content" id="sl-board"></div><button class="btn-glow mt-4" id="sl-reset">بُر زدن</button></div>`;
  let board=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,0],moves=0;
  function shuffle(){for(let i=0;i<200;i++){const e=board.indexOf(0);const r=Math.floor(e/4),col=e%4;const m=[];if(r>0)m.push(e-4);if(r<3)m.push(e+4);if(col>0)m.push(e-1);if(col<3)m.push(e+1);const t=m[Math.floor(Math.random()*m.length)];[board[e],board[t]]=[board[t],board[e]]}}
  function render(){const be=c.querySelector('#sl-board');be.innerHTML='';board.forEach((v,i)=>{const cell=document.createElement('div');cell.className='w-16 h-16 rounded-lg flex items-center justify-center font-bold text-xl cursor-pointer';if(v===0)cell.style.background='#0a0e1a';else{cell.style.background=`linear-gradient(135deg,hsl(${v*22},70%,45%),hsl(${v*22+20},70%,55%))`;cell.style.color='#fff';cell.textContent=toFa(v);cell.onclick=()=>move(i)}be.appendChild(cell)})}
  function move(i){const e=board.indexOf(0);const r1=Math.floor(i/4),c1=i%4,r2=Math.floor(e/4),c2=e%4;if(Math.abs(r1-r2)+Math.abs(c1-c2)===1){[board[i],board[e]]=[board[e],board[i]];moves++;c.querySelector('#sl-moves').textContent=toFa(moves);render();if(board.every((v,j)=>j===15?v===0:v===j+1))showToast('حل شد! 🎉')}}
  c.querySelector('#sl-reset').onclick=()=>{shuffle();moves=0;c.querySelector('#sl-moves').textContent='۰';render()};
  shuffle();render();return null
}

// ============ 15. REACTION TEST ============
function reactionInit(c){
  c.innerHTML=`<div class="text-center"><div class="w-full max-w-md mx-auto h-64 rounded-2xl flex items-center justify-center text-2xl font-bold cursor-pointer transition-colors" style="background:#2a3458" id="rt-box">برای شروع کلیک کنید</div><div class="mt-4 text-lg" id="rt-result"></div><div class="text-sm" style="color:var(--muted)" id="rt-best">بهترین: -</div></div>`;
  let state='idle',startTime=0,best=Infinity,timeout=null;const box=c.querySelector('#rt-box'),result=c.querySelector('#rt-result'),bestEl=c.querySelector('#rt-best');
  box.onclick=()=>{if(state==='idle'){state='wait';box.style.background='#8b1a1a';box.textContent='صبر کنید...';timeout=setTimeout(()=>{state='go';box.style.background='#00ff88';box.textContent='کلیک!';startTime=performance.now()},1000+Math.random()*3000)}else if(state==='wait'){clearTimeout(timeout);state='idle';box.style.background='#2a3458';box.textContent='زود کلیک کردید! دوباره'}else if(state==='go'){const t=Math.round(performance.now()-startTime);result.textContent=`${toFa(t)} میلی‌ثانیه`;if(t<best){best=t;bestEl.textContent=`بهترین: ${toFa(best)}ms`}state='idle';box.style.background='#2a3458';box.textContent='دوباره کلیک کنید'}};
  return()=>clearTimeout(timeout)
}

// ============ 16. STROOP (COLOR MATCH) ============
function stroopInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg">امتیاز: <span id="st-score">۰</span> | زمان: <span id="st-time">۳۰</span></div><div class="text-5xl font-bold my-6" id="st-word">آماده</div><div class="text-sm mb-3" style="color:var(--muted)">رنگ کلمه را حدس بزنید، نه معنی آن را</div><div class="grid grid-cols-2 gap-2 max-w-xs mx-auto" id="st-options"></div><button class="btn-glow mt-4" id="st-start">شروع</button></div>`;
  const colors=[{name:'قرمز',hex:'#ff2bd6'},{name:'آبی',hex:'#00f0ff'},{name:'سبز',hex:'#00ff88'},{name:'زرد',hex:'#ffd60a'},{name:'بنفش',hex:'#9d00ff'}];
  let score=0,time=30,current=null,timer=null,running=false;const wordEl=c.querySelector('#st-word'),optsEl=c.querySelector('#st-options');
  function next(){const text=colors[Math.floor(Math.random()*colors.length)];current=colors[Math.floor(Math.random()*colors.length)];wordEl.textContent=text.name;wordEl.style.color=current.hex;optsEl.innerHTML='';colors.forEach(cc=>{const b=document.createElement('button');b.className='btn-ghost p-3 font-bold';b.textContent=cc.name;b.onclick=()=>{if(!running)return;if(cc.name===current.name){score++;c.querySelector('#st-score').textContent=toFa(score)}else{wordEl.classList.add('shake');setTimeout(()=>wordEl.classList.remove('shake'),300)}next()};optsEl.appendChild(b)})}
  function start(){score=0;time=30;running=true;c.querySelector('#st-score').textContent='۰';c.querySelector('#st-time').textContent='۳۰';clearInterval(timer);timer=setInterval(()=>{time--;c.querySelector('#st-time').textContent=toFa(time);if(time<=0){clearInterval(timer);running=false;wordEl.textContent=`پایان! امتیاز: ${toFa(score)}`;optsEl.innerHTML=''}},1000);next()}
  c.querySelector('#st-start').onclick=start;
  return()=>{clearInterval(timer);running=false}
}

// ============ 17. MATH QUIZ ============
function mathInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg">امتیاز: <span id="mq-score">۰</span> | زنجیره: <span id="mq-streak">۰</span></div><div class="text-4xl font-bold my-6" id="mq-q">؟</div><div class="grid grid-cols-2 gap-2 max-w-xs mx-auto" id="mq-opts"></div><button class="btn-glow mt-4" id="mq-start">شروع</button></div>`;
  let score=0,streak=0,answer=0,running=false;const qEl=c.querySelector('#mq-q'),optsEl=c.querySelector('#mq-opts');
  function next(){const a=Math.floor(Math.random()*20)+1,b=Math.floor(Math.random()*20)+1;const ops=['+','-','×'];const op=ops[Math.floor(Math.random()*ops.length)];if(op==='+')answer=a+b;if(op==='-')answer=a-b;if(op==='×')answer=a*b;qEl.textContent=`${toFa(a)} ${op} ${toFa(b)} = ؟`;const options=new Set([answer]);while(options.size<4){let v=answer+Math.floor(Math.random()*10)-5;if(v!==answer&&v>=0)options.add(v)}const arr=[...options].sort(()=>Math.random()-.5);optsEl.innerHTML='';arr.forEach(v=>{const b=document.createElement('button');b.className='btn-ghost p-3 text-xl font-bold';b.textContent=toFa(v);b.onclick=()=>{if(!running)return;if(v===answer){score++;streak++;c.querySelector('#mq-score').textContent=toFa(score);c.querySelector('#mq-streak').textContent=toFa(streak)}else{streak=0;c.querySelector('#mq-streak').textContent='۰'}next()};optsEl.appendChild(b)})}
  c.querySelector('#mq-start').onclick=()=>{running=true;score=0;streak=0;c.querySelector('#mq-score').textContent='۰';c.querySelector('#mq-streak').textContent='۰';next()};
  return null
}

// ============ 18. DICE GAME ============
function diceInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg">شما: <span id="dc-y">۰</span> | کامپیوتر: <span id="dc-c">۰</span></div><div class="flex gap-8 justify-center my-4"><div><div class="text-7xl" id="dc-pdice">⚀</div><div class="text-sm mt-1" style="color:var(--muted)">شما</div></div><div><div class="text-7xl" id="dc-cdice">⚀</div><div class="text-sm mt-1" style="color:var(--muted)">کامپیوتر</div></div></div><div class="text-lg mb-3" id="dc-msg">بزرگ‌تر یا کوچک‌تر؟</div><div class="flex gap-2 justify-center"><button data-g="hi" class="btn-glow">بزرگ‌تر 📈</button><button data-g="lo" class="btn-glow">کوچک‌تر 📉</button></div><div class="mt-3 text-sm" style="color:var(--muted)" id="dc-last"></div></div>`;
  let y=0,comp=0;const faces=['⚀','⚁','⚂','⚃','⚄','⚅'];const pdice=c.querySelector('#dc-pdice'),cdice=c.querySelector('#dc-cdice'),msgEl=c.querySelector('#dc-msg'),lastEl=c.querySelector('#dc-last');
  function play(guess){let i=0;const interval=setInterval(()=>{pdice.textContent=faces[Math.floor(Math.random()*6)];cdice.textContent=faces[Math.floor(Math.random()*6)];i++;if(i>12){clearInterval(interval);const p=Math.floor(Math.random()*6)+1,a=Math.floor(Math.random()*6)+1;pdice.textContent=faces[p-1];cdice.textContent=faces[a-1];if(p===a)msgEl.textContent='مساوی! دوباره';else if((guess==='hi'&&p>a)||(guess==='lo'&&p<a)){y++;msgEl.textContent='بردیدید! 🎉';c.querySelector('#dc-y').textContent=toFa(y)}else{comp++;msgEl.textContent='باختید! 😢';c.querySelector('#dc-c').textContent=toFa(comp)}lastEl.textContent=`شما: ${toFa(p)} | کامپیوتر: ${toFa(a)}`}},70)}
  c.querySelectorAll('[data-g]').forEach(b=>b.onclick=()=>play(b.dataset.g));
  return null
}

// ============ 19. WORD SCRAMBLE ============
function scrambleInit(c){
  const words=['گلاب','موز','سیب','انار','گیلاس','هندوانه','خربزه','طالبی','پرتقال','لیمو','انگور','مغز','قلب','چشم','دست','پا','کتاب','مداد','صندلی','میز'];
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg">امتیاز: <span id="ws-score">۰</span></div><div class="text-3xl font-bold my-4 tracking-widest" id="ws-scrambled"></div><input type="text" class="rounded-lg px-4 py-2 text-center text-xl w-full max-w-xs mx-auto block" style="background:#1a2138;border:1px solid var(--border);color:var(--text)" placeholder="کلمه را بنویسید" id="ws-input"><div class="flex gap-2 justify-center mt-3"><button class="btn-glow" id="ws-check">بررسی</button><button class="btn-ghost" id="ws-skip">رد شدن</button></div><div class="mt-3 text-lg" id="ws-msg"></div></div>`;
  let score=0,word,scrambled;const scrEl=c.querySelector('#ws-scrambled'),inEl=c.querySelector('#ws-input'),msgEl=c.querySelector('#ws-msg');
  function shuffle(w){const arr=[...w];for(let i=arr.length-1;i>0;i--){const j=Math.floor(Math.random()*(i+1));[arr[i],arr[j]]=[arr[j],arr[i]]}return arr.join('')}
  function next(){word=words[Math.floor(Math.random()*words.length)];scrambled=shuffle(word);if(scrambled===word)scrambled=shuffle(word);scrEl.textContent=scrambled;inEl.value='';msgEl.textContent=''}
  function check(){if(inEl.value===word){score++;c.querySelector('#ws-score').textContent=toFa(score);msgEl.textContent='درست! 🎉';msgEl.style.color='#00ff88';setTimeout(next,800)}else{msgEl.textContent='نادرست!';msgEl.style.color='#ff4466'}}
  c.querySelector('#ws-check').onclick=check;
  inEl.addEventListener('keydown',e=>{if(e.key==='Enter')check()});
  c.querySelector('#ws-skip').onclick=()=>{msgEl.textContent=`جواب: ${word}`;msgEl.style.color='var(--muted)';setTimeout(next,1500)};
  next();return null
}

// ============ 20. TYPING SPEED ============
function typingInit(c){
  const sentences=['برنامه نویسی هنر حل مسئله است','تلاش مداوم کلید موفقیت است','یادگیری هر روز شما را قوی تر می کند','صبر و پشتکار به پیروزی می رسد','علم نور و جهل تاریکی است','سختی ها ما را قوی تر می سازند'];
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg">زمان: <span id="tp-time">۳۰</span> | کلمه/دقیقه: <span id="tp-wpm">۰</span></div><div class="text-xl my-4 p-4 rounded-xl leading-relaxed" style="background:#1a2138" id="tp-text"></div><textarea rows="3" class="rounded-lg px-4 py-2 w-full" style="background:#0a0e1a;border:1px solid var(--border);color:var(--text)" placeholder="اینجا تایپ کنید..." id="tp-input"></textarea><button class="btn-glow mt-3" id="tp-start">شروع</button></div>`;
  let text,time=30,timer=null,running=false;const textEl=c.querySelector('#tp-text'),inEl=c.querySelector('#tp-input');
  function start(){text=sentences[Math.floor(Math.random()*sentences.length)];textEl.innerHTML=[...text].map(ch=>`<span style="color:var(--muted)">${ch}</span>`).join('');inEl.value='';inEl.disabled=false;inEl.focus();time=30;running=true;c.querySelector('#tp-time').textContent='۳۰';c.querySelector('#tp-wpm').textContent='۰';clearInterval(timer);timer=setInterval(()=>{time--;c.querySelector('#tp-time').textContent=toFa(time);if(time<=0){clearInterval(timer);running=false;inEl.disabled=true;const typed=inEl.value.trim().split(/\s+/).filter(w=>w).length;c.querySelector('#tp-wpm').textContent=toFa(Math.round(typed*2));showToast('پایان!')}},1000)}
  inEl.addEventListener('input',()=>{if(!running)return;const typed=inEl.value;const spans=textEl.querySelectorAll('span');[...text].forEach((ch,i)=>{if(i<typed.length)spans[i].style.color=typed[i]===ch?'#00ff88':'#ff4466';else spans[i].style.color='var(--muted)'})});
  c.querySelector('#tp-start').onclick=start;
  return()=>{clearInterval(timer);running=false}
}

// ============ 21. LIGHTS OUT ============
function lightsInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg">حرکت: <span id="lo-moves">۰</span></div><div class="grid grid-cols-5 gap-1 mx-auto" style="width:max-content" id="lo-board"></div><div class="mt-3 text-lg" id="lo-msg"></div><button class="btn-glow mt-3" id="lo-reset">شروع مجدد</button><div class="text-xs mt-2" style="color:var(--muted)">روی یک چراغ کلیک کنید تا آن و همسایه‌هایش تغییر کنند. همه را خاموش کنید.</div></div>`;
  let grid=Array(25).fill(false),moves=0;
  function toggle(i){grid[i]=!grid[i];const r=Math.floor(i/5),col=i%5;if(r>0)grid[i-5]=!grid[i-5];if(r<4)grid[i+5]=!grid[i+5];if(col>0)grid[i-1]=!grid[i-1];if(col<4)grid[i+1]=!grid[i+1]}
  function render(){const be=c.querySelector('#lo-board');be.innerHTML='';grid.forEach((v,i)=>{const cell=document.createElement('div');cell.className='w-12 h-12 rounded-lg cursor-pointer transition-colors';cell.style.background=v?'#ffd60a':'#1a2138';cell.style.boxShadow=v?'0 0 15px #ffd60a':'none';cell.onclick=()=>{toggle(i);moves++;c.querySelector('#lo-moves').textContent=toFa(moves);render();if(grid.every(v=>!v))c.querySelector('#lo-msg').textContent='برنده شدید! 🎉'};be.appendChild(cell)})}
  function shuffle(){grid=Array(25).fill(false);for(let i=0;i<15;i++)toggle(Math.floor(Math.random()*25));if(grid.every(v=>!v))shuffle();moves=0}
  c.querySelector('#lo-reset').onclick=()=>{shuffle();c.querySelector('#lo-moves').textContent='۰';c.querySelector('#lo-msg').textContent='';render()};
  shuffle();render();return null
}

// ============ 22. MAZE ============
function mazeInit(c){
  const SIZE=11;let maze=[],px=1,py=1;
  c.innerHTML=`<div class="text-center"><div class="mx-auto inline-grid gap-0" id="mz-board"></div><div class="text-sm mt-2" style="color:var(--muted)">با کلیدهای جهت‌نما حرکت کنید</div><div class="grid grid-cols-3 gap-1 max-w-[150px] mx-auto mt-2 md:hidden"><div></div><button data-d="up" class="btn-ghost">▲</button><div></div><button data-d="left" class="btn-ghost">◀</button><button data-d="down" class="btn-ghost">▼</button><button data-d="right" class="btn-ghost">▶</button></div><button class="btn-glow mt-2" id="mz-reset">پیچ جدید</button></div>`;
  function gen(){maze=Array(SIZE*SIZE).fill(1);const stack=[[1,1]];maze[1*SIZE+1]=0;while(stack.length){const[x,y]=stack[stack.length-1];const dirs=[[0,-2],[0,2],[-2,0],[2,0]].sort(()=>Math.random()-.5);let moved=false;for(const[dx,dy]of dirs){const nx=x+dx,ny=y+dy;if(nx>0&&nx<SIZE-1&&ny>0&&ny<SIZE-1&&maze[ny*SIZE+nx]===1){maze[ny*SIZE+nx]=0;maze[(y+dy/2)*SIZE+(x+dx/2)]=0;stack.push([nx,ny]);moved=true;break}}if(!moved)stack.pop()}maze[(SIZE-2)*SIZE+(SIZE-2)]=0;px=1;py=1}
  function render(){const be=c.querySelector('#mz-board');be.style.gridTemplateColumns=`repeat(${SIZE},24px)`;be.innerHTML='';for(let y=0;y<SIZE;y++)for(let x=0;x<SIZE;x++){const cell=document.createElement('div');cell.className='w-6 h-6';if(x===SIZE-2&&y===SIZE-2)cell.style.background='#00ff88';else if(x===px&&y===py){cell.style.background='#ffd60a';cell.style.borderRadius='50%'}else if(maze[y*SIZE+x]===1)cell.style.background='#2a3458';else cell.style.background='#0a0e1a';be.appendChild(cell)}}
  function move(d){const dirs={up:[0,-1],down:[0,1],left:[-1,0],right:[1,0]};const[dx,dy]=dirs[d];const nx=px+dx,ny=py+dy;if(maze[ny*SIZE+nx]===0){px=nx;py=ny;render();if(px===SIZE-2&&py===SIZE-2)showToast('پیروزی! 🎉')}}
  const kh=e=>{const m={ArrowUp:'up',ArrowDown:'down',ArrowLeft:'left',ArrowRight:'right'};if(m[e.key]){e.preventDefault();move(m[e.key])}};
  document.addEventListener('keydown',kh);
  c.querySelectorAll('[data-d]').forEach(b=>b.onclick=()=>move(b.dataset.d));
  c.querySelector('#mz-reset').onclick=()=>{gen();render()};
  gen();render();return()=>document.removeEventListener('keydown',kh)
}

// ============ 23. TETRIS ============
function tetrisInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-2 text-lg">امتیاز: <span id="tt-score">۰</span> | خطوط: <span id="tt-lines">۰</span></div><canvas id="tt-canvas" width="200" height="400" class="mx-auto"></canvas><div class="text-sm mt-2" style="color:var(--muted)">← → حرکت | ↑ چرخش | ↓ پایین</div><div class="grid grid-cols-3 gap-1 max-w-[180px] mx-auto mt-2 md:hidden"><div></div><button data-k="ArrowUp" class="btn-ghost">↻</button><div></div><button data-k="ArrowLeft" class="btn-ghost">◀</button><button data-k="ArrowDown" class="btn-ghost">▼</button><button data-k="ArrowRight" class="btn-ghost">▶</button></div><button class="btn-glow mt-2" id="tt-start">شروع</button></div>`;
  const canvas=c.querySelector('#tt-canvas'),ctx=canvas.getContext('2d');
  const COLS=10,ROWS=20,CELL=20;
  const shapes=[[[1,1,1,1]],[[1,1],[1,1]],[[1,1,1],[0,1,0]],[[1,1,1],[1,0,0]],[[1,1,1],[0,0,1]],[[0,1,1],[1,1,0]],[[1,1,0],[0,1,1]]];
  const colors=['#00f0ff','#ffd60a','#ff2bd6','#ff8c00','#0066ff','#00ff88','#ff0040'];
  let grid,piece,score,lines,running=false,dropTimer=null;
  function newPiece(){const i=Math.floor(Math.random()*shapes.length);piece={shape:shapes[i],color:colors[i],x:3,y:0}}
  function init(){grid=Array(ROWS*COLS).fill(null);score=0;lines=0;newPiece();c.querySelector('#tt-score').textContent='۰';c.querySelector('#tt-lines').textContent='۰'}
  function collides(p,dx=0,dy=0,shape=p.shape){for(let r=0;r<shape.length;r++)for(let col=0;col<shape[r].length;col++)if(shape[r][col]){const x=p.x+col+dx,y=p.y+r+dy;if(x<0||x>=COLS||y>=ROWS||(y>=0&&grid[y*COLS+x]))return true}return false}
  function merge(){piece.shape.forEach((row,r)=>row.forEach((v,col)=>{if(v)grid[(piece.y+r)*COLS+(piece.x+col)]=piece.color}))}
  function clearLines(){let cleared=0;for(let r=ROWS-1;r>=0;r--){if(grid.slice(r*COLS,r*COLS+COLS).every(v=>v)){grid.splice(r*COLS,COLS);grid=Array(COLS).fill(null).concat(grid);cleared++;r++}}if(cleared){lines+=cleared;score+=[0,40,100,300,1200][cleared];c.querySelector('#tt-score').textContent=toFa(score);c.querySelector('#tt-lines').textContent=toFa(lines)}}
  function rotate(shape){const r=shape.length,col=shape[0].length;const n=Array(col).fill(null).map(()=>Array(r).fill(0));for(let i=0;i<r;i++)for(let j=0;j<col;j++)n[j][r-1-i]=shape[i][j];return n}
  function draw(){ctx.fillStyle='#0a0e1a';ctx.fillRect(0,0,canvas.width,canvas.height);for(let r=0;r<ROWS;r++)for(let col=0;col<COLS;col++)if(grid[r*COLS+col]){ctx.fillStyle=grid[r*COLS+col];ctx.fillRect(col*CELL,r*CELL,CELL-1,CELL-1)}piece.shape.forEach((row,r)=>row.forEach((v,col)=>{if(v){ctx.fillStyle=piece.color;ctx.fillRect((piece.x+col)*CELL,(piece.y+r)*CELL,CELL-1,CELL-1)}}))}
  function step(){if(!running)return;if(!collides(piece,0,1))piece.y++;else{merge();clearLines();newPiece();if(collides(piece)){running=false;clearInterval(dropTimer);showToast(`بازی تمام! امتیاز: ${toFa(score)}`);return}}draw()}
  function handleKey(k){if(!running)return;if(k==='ArrowLeft'&&!collides(piece,-1,0))piece.x--;if(k==='ArrowRight'&&!collides(piece,1,0))piece.x++;if(k==='ArrowDown'&&!collides(piece,0,1))piece.y++;if(k==='ArrowUp'){const r=rotate(piece.shape);if(!collides(piece,0,0,r))piece.shape=r}draw()}
  const kh=e=>{if(['ArrowUp','ArrowDown','ArrowLeft','ArrowRight'].includes(e.key)){e.preventDefault();handleKey(e.key)}};
  document.addEventListener('keydown',kh);
  c.querySelectorAll('[data-k]').forEach(b=>b.onclick=()=>handleKey(b.dataset.k));
  c.querySelector('#tt-start').onclick=()=>{init();running=true;draw();clearInterval(dropTimer);dropTimer=setInterval(step,500)};
  return()=>{running=false;clearInterval(dropTimer);document.removeEventListener('keydown',kh)}
}

// ============ 24. AIM TRAINER ============
function aimInit(c){
  c.innerHTML=`<div class="text-center"><div class="mb-3 text-lg">امتیاز: <span id="am-score">۰</span> | زمان: <span id="am-time">۲۰</span></div><div class="relative w-full max-w-md h-80 mx-auto rounded-xl overflow-hidden" style="background:#0a0e1a;border:1px solid var(--border)" id="am-area"><div class="absolute inset-0 flex items-center justify-center" style="color:var(--muted)">برای شروع دکمه را بزنید</div></div><button class="btn-glow mt-4" id="am-start">شروع</button></div>`;
  let score=0,time=20,running=false,timer=null,spawnInt=null;const area=c.querySelector('#am-area');
  function spawn(){const t=document.createElement('div');const x=Math.random()*(area.clientWidth-40),y=Math.random()*(area.clientHeight-40);t.className='absolute rounded-full cursor-pointer';t.style.cssText=`left:${x}px;top:${y}px;width:40px;height:40px;background:radial-gradient(circle,#ff2bd6,#ff0040);box-shadow:0 0 15px #ff2bd6`;t.onclick=()=>{if(running){score++;c.querySelector('#am-score').textContent=toFa(score);t.remove();spawn()}};area.appendChild(t);setTimeout(()=>t.remove(),1500)}
  function start(){score=0;time=20;running=true;area.innerHTML='';c.querySelector('#am-score').textContent='۰';c.querySelector('#am-time').textContent='۲۰';clearInterval(timer);clearInterval(spawnInt);timer=setInterval(()=>{time--;c.querySelector('#am-time').textContent=toFa(time);if(time<=0){clearInterval(timer);clearInterval(spawnInt);running=false;showToast(`پایان! امتیاز: ${toFa(score)}`)}},1000);spawnInt=setInterval(()=>{if(running)spawn();else clearInterval(spawnInt)},800);spawn()}
  c.querySelector('#am-start').onclick=start;
  return()=>{clearInterval(timer);clearInterval(spawnInt);running=false}
}

// ============ GAMES REGISTRY ============
const games=[
  {id:'tictactoe',name:'دوز',cat:'strategy',icon:'🎯',desc:'بازی کلاسیک دوز با هوش مصنوعی',init:tictactoeInit},
  {id:'connect4',name:'چهار در صف',cat:'strategy',icon:'🔴',desc:'چهار مهره را در یک ردیف بچینید',init:connect4Init},
  {id:'hangman',name:'مرد حکومی',cat:'strategy',icon:'🔤',desc:'کلمه پنهان را حدس بزنید',init:hangmanInit},
  {id:'scramble',name:'کلمه درهم',cat:'strategy',icon:'🔀',desc:'کلمه به هم ریخته را مرتب کنید',init:scrambleInit},
  {id:'memory',name:'حافظه',cat:'memory',icon:'🃏',desc:'کارت‌های همسان را پیدا کنید',init:memoryInit},
  {id:'simon',name:'سایمون',cat:'memory',icon:'🎵',desc:'دنباله رنگی را به خاطر بسپارید',init:simonInit},
  {id:'stroop',name:'تطابق رنگ',cat:'memory',icon:'🌈',desc:'رنگ کلمه را حدس بزنید',init:stroopInit},
  {id:'snake',name:'مار',cat:'action',icon:'🐍',desc:'غذا بخور و رشد کن',init:snakeInit},
  {id:'whack',name:'موش‌کوب',cat:'action',icon:'🔨',desc:'موش‌ها را سریع بزنید',init:whackInit},
  {id:'flappy',name:'پرنده',cat:'action',icon:'🐤',desc:'از لوله‌ها عبور کنید',init:flappyInit},
  {id:'pong',name:'پنگ',cat:'action',icon:'🏓',desc:'پنگ کلاسیک با کامپیوتر',init:pongInit},
  {id:'breakout',name:'آجر شکن',cat:'action',icon:'🧱',desc:'همه آجرها را بشکنید',init:breakoutInit},
  {id:'aim',name:'هدف‌گیر',cat:'action',icon:'🎯',desc:'اهداف را سریع بزنید',init:aimInit},
  {id:'2048',name:'۲۰۴۸',cat:'puzzle',icon:'🔢',desc:'عددها را ادغام کنید تا ۲۰۴۸',init:game2048Init},
  {id:'mines',name:'مین‌یاب',cat:'puzzle',icon:'💣',desc:'مین‌ها را پیدا نکنید',init:minesInit},
  {id:'slide',name:'پازل کشویی',cat:'puzzle',icon:'🧩',desc:'اعداد را مرتب کنید',init:slideInit},
  {id:'lights',name:'چراغ خاموش',cat:'puzzle',icon:'💡',desc:'همه چراغ‌ها را خاموش کنید',init:lightsInit},
  {id:'maze',name:'هزارتو',cat:'puzzle',icon:'🧭',desc:'از هزارتو فرار کنید',init:mazeInit},
  {id:'tetris',name:'تتریس',cat:'puzzle',icon:'🟦',desc:'بلوک‌ها را بچینید',init:tetrisInit},
  {id:'reaction',name:'واکنن‌سنج',cat:'skill',icon:'⚡',desc:'سرعت واکنش خود را بسنجید',init:reactionInit},
  {id:'typing',name:'تایپ‌سنج',cat:'skill',icon:'⌨️',desc:'سرعت تایپ خود را بسنجید',init:typingInit},
  {id:'math',name:'ریاضی سریع',cat:'skill',icon:'➗',desc:'سریع پاسخ دهید',init:mathInit},
  {id:'rps',name:'سنگ کاغذ قیچی',cat:'classic',icon:'✊',desc:'با کامپیوتر بازی کنید',init:rpsInit},
  {id:'dice',name:'تاس',cat:'classic',icon:'🎲',desc:'بزرگ‌تر یا کوچک‌تر',init:diceInit},
];

const categories={all:'همه بازی‌ها',strategy:'استراتژی',memory:'حافظه',action:'اکشن',puzzle:'پازل',skill:'مهارت',classic:'کلاسیک'};
let activeCat='all',currentCleanup=null;

function renderCategories(){const c=document.getElementById('categories');c.innerHTML='';Object.entries(categories).forEach(([key,label])=>{const pill=document.createElement('div');pill.className='cat-pill'+(activeCat===key?' active':'');pill.textContent=label;pill.onclick=()=>{activeCat=key;renderCategories();renderGrid()};c.appendChild(pill)})}
function renderGrid(){const grid=document.getElementById('games-grid');grid.innerHTML='';games.filter(g=>activeCat==='all'||g.cat===activeCat).forEach(g=>{const card=document.createElement('div');card.className='game-card p-4 flex flex-col items-center text-center gap-2';card.innerHTML=`<div class="game-icon">${g.icon}</div><h3 class="font-bold text-lg">${g.name}</h3><p class="text-xs flex-1" style="color:var(--muted)">${g.desc}</p><div class="text-xs px-2 py-1 rounded-full" style="background:var(--border)">${categories[g.cat]}</div>`;card.onclick=()=>openGame(g);grid.appendChild(card)})}
function openGame(g){const modal=document.getElementById('modal');document.getElementById('modal-title').textContent=g.name;document.getElementById('modal-desc').textContent=g.desc;const container=document.getElementById('game-container');container.innerHTML='';modal.classList.add('active');if(currentCleanup)try{currentCleanup()}catch(e){}currentCleanup=g.init(container)||null}
document.getElementById('modal-close').onclick=()=>{document.getElementById('modal').classList.remove('active');if(currentCleanup)try{currentCleanup()}catch(e){}currentCleanup=null;document.getElementById('game-container').innerHTML=''};
document.getElementById('modal').onclick=e=>{if(e.target.id==='modal')document.getElementById('modal-close').click()};

renderCategories();renderGrid();document.getElementById('game-count').textContent=toFa(games.length);
</script>
</body>
</html>