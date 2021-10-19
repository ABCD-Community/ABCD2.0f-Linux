#executed below with errors:
mx title "join=../../titleplus/data/titleplus,907,37,140,912,913,400,460,480,490,610,900,946,940,941,950,951,993,440,30=mhu,(v30/)" create=newtitle -all now tell=10



mx title "join=../../titleplus/data/titleplus,903,907,037,30=mhu,(v30/)" create=newtitle -all now tell=10


mx title "join=../../titleplus/data/titleplus,903,30=mhu,(|ID=|v30/)" create=newtitle -all now tell=10

mx title join="../../titleplus/data/titleplus,903,907,037,140,912,913,460,950,951,993,440=mhu,(v440/)" create=newtitle -all now tell=10 

mx title join="../../titleplus/data/titleplus,907,037,140,912,913,460,400,460,480,490,610,900,946,940,941,950,951,993,440=mhu,(v440/)" create=newtitle -all now tell=10
mx title "jchk=../../titleplus/data/titleplus=mhu,(v440/)" create=newtitle now -all tell=10

mx title "jchk=../../titleplus/data/titleplus=v907,v993,v910,v912,v460,mhu,(v440/)" create=newtitle now -all tell=10

#mx nml join=../../titleplus/data/titleplus,907,037,140,440=(v440/),913,912,940,941,950,951,993 create=titnew now -all
#mx nawic join=nawicnew,99,996,913=mhu,(v913/) create=nawnew now -all
