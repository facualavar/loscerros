<style>
   .footer {
        width: 100%;
        text-align: center;
        position: fixed;
    }
    .header {
        top: -15px;
        position: fixed;
        width: 100%;
        font-size: 13.5px;
        /*margin-bottom: 195px;*/
        line-height: 1.42857143;
    }
    .footer {
        bottom: 30px;
        font-size: 13px;
    }

    span.page-numbers:before {
        counter-increment: pages;
    }

    span.page-number:before {
            content: counter(page) "" counters(pages);
           /* counter-increment: pages;    */
    }

    .linea{       width: 100%;
                  margin-left: 0%;
                  /* margin-top: 32px; */
                  margin-bottom: 11px;
                  border: 0;
                  border-top: 1px solid #201414;}

    .linea2{      width: 102%;
                  margin-left: 0%;
                  margin-top: -2px;
                  margin-bottom: 11px;
                  border: 0;
                  border-top: 1px solid #201414;}

    .linea3{      width: 102%;
                  margin-left: 0%;
                  margin-top: 12px;
                  margin-bottom: 11px;
                  border: 0;
                  border-top: 1px solid #201414;}

    .linea1{    width: 102%;
                margin-left: 0%;
                margin-top: 0px;
                /* margin-bottom: -11px; */
                border: 0;
                border-top: 1px solid #201414;
                display: inline-block;}

    .top{display: inline-block; margin-top: 1.1%;}

    .img{
          width: 77%;
    }

    @page { margin-top: 40px; }

    .saltos { page-break-inside: avoid; }

    .italica { font-style: italic; }

    body { margin-bottom: 80px; margin-top: 115px; font-family: sans-serif; line-height: 1.32857143; font-size: 13px;}
</style>
