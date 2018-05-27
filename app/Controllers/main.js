var uuid = (function(){
    var uid = 0;
  return {
    getNextUid: function(){
      return uid++;
    }
  }
})();

var Cell = function( width, height ){
  this.width = width || "10px";
  this.height = height || "10px";
  this.cellpos = null;
};
Cell.prototype = {
  constructor: Cell,
  newCell: function(){
    this.cellpos = this.getNewId();
    var cell =  document.createElement("div");
    cell.styleText = "height:"+ this.height +"width:"+ this.width;
    cell.className = "comp-cell";
    cell.setAttribute("data-cellpos", this.cellpos);
    this.el = cell;
    return cell;
  },
  render: function( elem ){
    elem.appendChild( this.newCell() );
  },
  getNewId: function(){
    return uuid.getNextUid();
  },
  markSymbol: function( symbol ){
      this.el.innerHTML = symbol;
      this.marked = true;
  }
};

var CellFactory = {
  newCell:  function(){
      return new Cell;
  }
};

var Board = function(){
    this.cells = [];
};
Board.prototype = {
  constructor: Board,
  cellcount : 9,
  init : function(){
  for(var i=0,len=this.cellcount;i<len;i++){
      var newcell = CellFactory.newCell()
      this.cells.push(newcell);
    }
   this.render();
  },
  render: function(){
    var board = document.createElement("div"),curcell;
    board.className = "comp-board";
    for(var i=0,len=this.cells.length;i<len;i++){
      curcell = this.cells[i];
      curcell.render(board);
    }
    document.body.appendChild( board );
    this.el = board;
    this.attachEvents();
  },
  findCell: function(cellpos){
      var cellmatched = null;
    for(var i=0,len=this.cells.length;i<len;i++){
      if( this.cells[i].cellpos == cellpos ){
        cellmatched = this.cells[i];
        break;
      }
    }
    return cellmatched;
  },
  clearCells: function(){
    for(var i=0,len=this.cells.length;i<len;i++){
       this.cells[i].marked = false;
       this.cells[i].el.innerHTML = "";
    }
  },
  attachEvents: function(){
    var board = this;
    this.el.addEventListener("click", function(evobj){
        
          var target = evobj.target,cellclicked,
              cellpos = target.getAttribute("data-cellpos");
      if(cellpos && cellpos !=="undefined"){
         evobj.stopPropagation();
         cellclicked = board.findCell(cellpos);
        if(!!cellclicked && !cellclicked.marked){
          board.onCellClick.call(board,cellclicked);
        }
      }
    });
  }
};

var Player = function(name){
  this.name = name || "";
  this.selectedCells = [];
  this.symbol =  "";
};
Player.prototype = {
  constructor: Player,
  setSymbol: function(symbol){
   this.symbol = symbol || "";
  },
  addCell : function( cellpos ){
      this.selectedCells.push(cellpos);
  },
  getCells: function(){
        return this.selectedCells;
  },
  clearCells: function(){
      this.selectedCells = [];
  }
};

var Message = function( elemid ){
    this.elemid = elemid || "";
    this.render();
}
Message.prototype = {
  constructor: Message,
  render : function(){
      var message = document.createElement("div");
      message.className = "comp-message";
      document.body.appendChild(message);
      this.el = message;
  },
  notify: function( message ){
      this.el.innerHTML = message || "";
  }
}

var Game = {
  configure : function( options ){
    this.options = options || null;
    return this;
  },
  start: function(){
    if(!this.options){
      return;
    }
    var players = this.options.players,
        board = this.options.board,
        game = this;
    board.init();
    players[0].setSymbol("O");
    players[1].setSymbol("X");
    game.setActivePlayer( players[0] );
    board.onCellClick = function( cell ){
        cell.markSymbol( game.activeplayer.symbol );
        game.activeplayer.addCell( cell.cellpos );
        var gameover = game.evaluate();
        if(!gameover){
           game.switchPlayers();
        } else {
          game.end();
        }
    };
    this.started = true;
  },
  evaluate: function(){
     var gameover = false,
         selectedcells = this.activeplayer.getCells();
    if(selectedcells.length>=3){
      selectedcells = selectedcells.sort();
      gameover = (( selectedcells[0] + selectedcells[2] ) / 2 === selectedcells[1] ) ? true: false;
    }
     return gameover;
  },
  restart: function(){
    if(!this.started){
      this.start();
      return;
    }
    this.options.board.clearCells();
    this.options.players[0].clearCells();
    this.options.players[1].clearCells();    
    this.setActivePlayer( this.options.players[Math.floor(Math.random()*2)]);
  },
  end: function(){
    this.options.message.notify( this.activeplayer.name + " Won The GAME !!!");
  },
  setActivePlayer: function( player ){
      this.activeplayer = player;
    this.options.message.notify( "Next player is : "+ player.name + "")
  },
  switchPlayers: function(){ 
    var nextplayer = this.activeplayer === this.options.players[0] ? this.options.players[1]: this.options.players[0];
      this.setActivePlayer( nextplayer )
  }
};

Game.configure({
  board: new Board,
  players: [new Player("Leo"),new Player("John")],
  message: new Message
}).start();