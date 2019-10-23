const wildNode = ['W','I',"L","D"]
let score = 0
let wildCount = 0
let toggler = 0
let grid = [
  [0,0,0,0],
  [0,0,0,0],
  [0,0,0,0],
  [0,0,0,0]
]
// let grid = [
//   ['W',32,16,64],
//   [8,7,'I',5],
//   ['L',2,8,4],
//   [4,128,256,'D']
// ]
const song = new soundSetting()
let col = Array.from(document.querySelectorAll('.playground .col p'))
let counter = 0
const scoreDisplay = document.querySelector('.this-score p:nth-child(2)')
const bestScoreDisplay = document.querySelector('.best-score p:nth-child(2)')
const audioSetting = document.querySelector('.audio-setting')
const loosNotif = document.querySelector('.loos')
const winNotif = document.querySelector('.win')


// TODO: user interaction
// * start game 
const startBtn = document.querySelector('#start')
const starIns = document.querySelector('.start-game')
startBtn.addEventListener('click',(e)=>{
  (e.target).classList.add('bounce')
  starIns.classList.add('hidden')
  starIns.addEventListener('webkitAnimationEnd', e => {
    if (e.animationName = 'hidden') {
      e.srcElement.setAttribute('style','display : none')
    }
  }
  )
  gameStart()
})
// *audio
audioSetting.addEventListener('click', e => {
  e.preventDefault()
  if (toggler == 0) {
    e.currentTarget.style.backgroundImage = 'url("./assets/speaker-mute.svg")'
    song.pause()
    toggler = 1
  }else{
    e.currentTarget.style.backgroundImage = 'url("./assets/speaker.svg")'
    song.play()
    toggler = 0
  }
  
})
//  * tombol di klik
document.addEventListener('keydown', e =>{
  let gridClone = [
    [0,0,0,0],
    [0,0,0,0],
    [0,0,0,0],
    [0,0,0,0]
  ]
  for (let i = 0; i < 4; i++) {
    for (let j = 0; j < 4; j++) {
      gridClone[i][j] = grid[i][j]
    }
  }

  const keyController = ['ArrowUp','w','ArrowDown','s','ArrowLeft','a','ArrowRight','d']
  switch (e.key) {
    case 'ArrowUp' :
      case 'w' :
        geserAtas()
        sumNumber('atas')
        geserAtas()
      break;
    case 'ArrowDown' :
      case 's' :
        geserBawah()
        sumNumber('bawah')
        geserBawah()
        break;
    case 'ArrowLeft' :
      case 'a' :
        geserKiri()
        sumNumber('kiri')
        geserKiri()
        break;
    case 'ArrowRight' :
      case 'd' :
          geserKanan()
          sumNumber('kanan')
          geserKanan()
        break;
  }
  if (keyController.includes(e.key)) {
    e.preventDefault()
    checkChange(gridClone)
    refreshNumb()
    amWin()
  }
})


// TODO: recode funsi dari sketch.js || game logic
// * menampilkan nomor ke grid || refresh tampilan nomer
function refreshNumb(){
  for (let i = 0; i < grid.length; i++) {
    for (let j = 0; j < grid[i].length; j++) {
      col[counter].innerHTML = grid[i][j]
      col[counter].style.backgroundColor = numbColor(grid[i][j])
      counter +=1
      counter = counter > 15 ? 0 : counter
    }
  }
  scoreDisplay.innerHTML = score
  checkBestScore(score)
  bestScoreDisplay.innerHTML = localStorage.getItem('bestScore')
}
// * memulai game nya
function gameStart() {
  addNumber()
  addNumber()
  if (localStorage.getItem('bestScore') == null) {
    localStorage.setItem('bestScore',score)
  }else{
    localStorage.getItem('bestScore')
  }
  song.play()
  refreshNumb()
}
// * tambah nomer acak
function addNumber() {
  let gridTmp = []
  for (let x = 0; x < grid.length; x++) {
    for (let y = 0; y < grid[x].length; y++) {
      if(grid[x][y] == 0 ) gridTmp.push({x,y}) ;
    }
  }
  if (gridTmp != 0) {
    let pos = gridTmp[Math.floor(Math.random() * gridTmp.length)]
    if (wildCount == 8) {
      wildCount = 0
      grid[pos.x][pos.y] = wildNode[Math.floor(Math.random() * wildNode.length)]
    }else{
      Math.random() > 0.5 ? grid[pos.x][pos.y] = 2 : grid[pos.x][pos.y] = 4 ;
    }
  }
}
// * tambahkan nomer yang sama [baris]
function sumNumber(dir) {
  for (let i = col.length-1; i >= 0; i--) {
    if(col[i-1] == col[i]){
      col[i] += col[i-1]
      col[i-1] = 0
    }
  }
  switch (dir) {
    case 'kanan':
        for (let i = 3; i >= 0; i--) {
          for (let j = 3; j >= 0; j--) {
            if (isNaN(grid[i][j]) || isNaN(grid[i][j-1])) {
              if (wildNode.includes(grid[i][j-1]) && grid[i][j] != 0) {
                grid[i][j] *= 2
                grid[i][j-1] = 0
                addScore(grid[i][j]*2)
              }else if(wildNode.includes(grid[i][j]) && grid[i][j-1] != 0){
                grid[i][j-1] *= 2
                grid[i][j] = 0
                addScore(grid[i][j-1]*2)                
              }
            }
            else if( j != 0 && grid[i][j] == grid[i][j-1]) {
              grid[i][j] *= 2
              grid[i][j-1] = 0
              addScore(grid[i][j])
            }
          }
        }
    break;
    case 'kiri' :
        for (let i = 0; i < 4; i++) {
          for (let j = 0; j < 4; j++) {
            if (isNaN(grid[i][j]) || isNaN(grid[i][j+1])) {
              if (wildNode.includes(grid[i][j+1]) && grid[i][j] != 3) {
                grid[i][j] *= 2
                grid[i][j+1] = 0
                addScore(grid[i][j]*2)
              }else if(wildNode.includes(grid[i][j]) && grid[i][j+1] != 3){
                grid[i][j+1] *= 2
                grid[i][j] = 0
                addScore(grid[i][j+1]*2)                
              }
            }
            else if( j != 3 && grid[i][j] == grid[i][j+1]) {
              grid[i][j] *= 2
              grid[i][j+1] = 0
              addScore(grid[i][j])
            }
          }
        }
    break;
    case 'bawah' :
        for (let i = 3; i >= 0; i--) {
          for (let j = 3; j >= 0; j--) {
            if (j !=0 && isNaN(grid[j-1][i]) || isNaN(grid[j][i])) {
              if (wildNode.includes(grid[j-1][i]) && grid[j][i] != 0){
                grid[j][i] *=2
                grid[j-1][i] = 0
                addScore(grid[j][i]*2)
              }else if(wildNode.includes(grid[j][i]) && grid[j-1][i] != 0){
                grid[j-1][i] *=2
                grid[j][i] = 0
                addScore(grid[j-1][i]*2)
              }
            }
            else if ( j != 0 && grid[j][i] == grid[j-1][i]) {
              grid[j][i] *= 2
              grid[j-1][i] = 0
            }
          }
        }
    break;
    case 'atas' :
        for (let i = 0; i <= 3; i++) {
          for (let j = 0; j <= 3; j++) {
            if (j !=3 && isNaN(grid[j+1][i]) || isNaN(grid[j][i])) {
              if (wildNode.includes(grid[j+1][i]) && grid[j][i] != 0){
                grid[j][i] *=2
                grid[j+1][i] = 0
                addScore(grid[j][i]*2)
              }else if(wildNode.includes(grid[j][i]) && grid[j+1][i] != 0){
                grid[j+1][i] *=2
                grid[j][i] = 0
                addScore(grid[j+1][i]*2)
              }
            }
            else if ( j != 3 && grid[j][i] == grid[j+1][i]) {
              grid[j][i] *= 2
              grid[j+1][i] = 0
            }
          }
        }
      break;
  }
  
}
// * geser angkanya
function doSlide(row,dir = 'right'){
  let arr = row.filter( v => v)
  let zeros = Array(4-arr.length).fill(0)
  return dir == 'right' ? zeros.concat(arr) : arr.concat(zeros)
}
// ! geser angka per bagian ! 
function geserKanan() {
  for (let i = 0; i < 4; i++) {
    grid[i] = doSlide(grid[i])
  }
}
function geserKiri() {
  for (let i = 0; i < 4; i++) {
    grid[i] = doSlide(grid[i],'kiri')
  }
}
function geserBawah() {
  let gridTmp = [
    [0,0,0,0],
    [0,0,0,0],
    [0,0,0,0],
    [0,0,0,0]
  ]
  for (let i = 0; i < 4; i++) {
    for (let j = 0; j < 4; j++) {
      gridTmp[i][j] = grid[j][i]
    }
    gridTmp[i] = doSlide(gridTmp[i])
  }

  for (let i = 0; i < 4; i++) {
    for (let j = 0; j < 4; j++) {
      grid[i][j] = gridTmp[j][i]
    }
  }
}
function geserAtas() {
  let gridTmp = [
    [0,0,0,0],
    [0,0,0,0],
    [0,0,0,0],
    [0,0,0,0]
  ]
  for (let i = 0; i < 4; i++) {
    for (let j = 0; j < 4; j++) {
      gridTmp[i][j] = grid[j][i]
    }
    gridTmp[i] = doSlide(gridTmp[i],'kiri')
  }
  for (let i = 0; i < 4; i++) {
    for (let j = 0; j < 4; j++) {
      grid[i][j] = gridTmp[j][i]
    }
  }
}
// * cek apakah ada perubahan ?
function checkChange(gridClone){
  if (JSON.stringify(grid) != JSON.stringify(gridClone)) {
    addNumber()
    wildCount +=1
  }
}
// * tambah skor
function addScore(newScore){
  score += newScore
}
// *cek menang || kalah
function amWin() {
  let zeros = []
  let loos = 0
  for (let i = 0; i < 4; i++) {
    for (let j = 0; j < 4; j++) {
      if (grid[i][j] == 0) {
        zeros.push(grid[i][j])
      }else if (isNaN(grid[i][j])) {
        zeros.push('nan')
      }
    }
  }

  for (let i = 0; i < grid.length; i++) {
    for (let j = 0; j < grid[i].length; j++) {
      if (grid[i][j] >= 512 ) {
        winNotif.style.display = 'flex'
      }
      if (zeros.length == 0 && !((j != 3 && grid[i][j] == grid[i][j+1]) || (j != 3 && grid[j][i] == grid[j+1][i]))) {
        loos +=1
      }
    }
  }
  if(loos == 16){
    loosNotif.style.display = 'flex'
  }
}
// * check best score
function checkBestScore(score) {
  if (score > localStorage.getItem('bestScore')) {
    localStorage.setItem('bestScore',score)
  }
}
// ! setting bg song ! 
function soundSetting() {
  this.sound = document.createElement('audio')
  this.sound.src = './bg-song.mp3'
  this.sound.setAttribute('preload','auto')
  this.sound.setAttribute('controls','none')
  this.sound.style.display = 'none'
  document.body.appendChild(this.sound)
  return this.sound
}
function numbColor(grid){
     switch (grid) {
      case 2:
         return 'green'
         break;
      case 4:
         return 'red'
         break;
      case 8:
         return 'yellow'
         break;
      case 16:
         return 'cyan'
         break;
     case 32:
         return 'brown'
         break;
     case 64:
         return 'purple'
         break;
     case 128:
         return 'green'
         break;
     case 256:
         return 'green'
         break;
     case 512:
         return 'green'
         break;
       default:
         return 'transparant'
         break;
     }
}