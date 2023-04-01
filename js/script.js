var app = new Vue({
    el: '#app',
    data: {
      mulai: true,
      selesai: false,
      gejala: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
      tanya:
      {
          0:false,
          1:false,
          2:false,
          3:false,
          4:false,
          5:false,
          6:false,
          7:false,
          8:false,
          9:false,
          10:false,
          11:false,
          12:false,
          13:false,
          14:false,
          15:false,
          16:false,
          17:false
      },
      diagnostic: '',
    },  
        route1: function (index, nilai) {
            this.gejala[index] = nilai;
            this.visible[index] = false;
            if (index == 1) {
                this.visible[3] = true;
            }else if (index == 0){

            }else if (index == 0){
              this.selesai = true;
              this.mulai = false;
              this.diagnosa()
          }
        },
  
      diagnosa() {
          cf = [0,0,0,0,0,0,0,0];
  
          for (var i = 0; i < cf.length; i++) {
              cf[i] = this.bobot[i] * this.symtoms[i];
  
              if (i == 0) {
                  this.cfCombine = this.cfCombine + cf[i];
              } else {
                  this.cfCombine = (this.cfCombine + cf[i] * (1 - this.cfCombine));
              }
          }
  
          this.cfCombine = (Math.round(this.cfCombine * 10000) *100) / 10000;
  
          if (this.cfCombine >= 0 && this.cfCombine <= 50) {
              this.diagnostic = 'KEMUNGKINAN yang KECIL';
          } else if (this.cfCombine > 50 && this.cfCombine <= 79) {
              this.diagnostic = 'KEMUNGKINAN';
          } else if (this.cfCombine > 79 && this.cfCombine <= 99) {
              this.diagnostic = 'KEMUNGKINAN YANG BESAR';
          } else {
              this.diagnostic = 'SANGAT YAKIN';
          }
      },
  
  
    }
  });
  
  if ('serviceWorker' in navigator) {
      window.addEventListener('load', function () {
          navigator.serviceWorker.register('/sispakv2/sw.js').then(function(registration){
              console.log('ServiceWorker registration successfully with scope: ', registration.scope);
          }, function(err){
              console.log('ServiceWorker registration failed: ', err);
          });
      });
  }