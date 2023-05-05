var mydate=new Date()
        var year=mydate.getYear()
        if (year <1000)
        year+=1900
        var day=mydate.getDay()
        var month=mydate.getMonth()
        var daym=mydate.getDate()
        if (daym<10)
        daym="0"+daym
        var dayarray=new Array("Domenica ","Lunedì ","Martedì ","Mercoledì ","Giovedì ","Venerdì ","Sabato ")
        var montharray=new Array("/01/","/02/","/03/"," /04/","/05/","/06/","/07/","/08/","/09/","/10/","/11/","/12/")
        document.write(dayarray[day]+daym+montharray[month]+year)