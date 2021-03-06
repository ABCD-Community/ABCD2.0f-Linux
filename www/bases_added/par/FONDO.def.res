[FILE_LOCATION]

FILE DATABASE.*=%path_database%fondo/data/fondo.*
FILE standard.pft=%path_database%fondo/pfts/%lang%/fondo.pft
FILE SHORTCUT.IAH=%path_database%fondo/pfts/%lang%/shortcut.pft
FILE GXML=%path_database%gizmo/gXML.*

[INDEX_DEFINITION]

INDEX TW=^1defecto^2defecto^3default^4d?faut^d*^xTW ^uTW_^yDATABASE^mTW_
INDEX Au=^1Autor^2Autor^3Author^4Auteur^xAU ^uAU_^yDATABASE^mAU_
INDEX De=^1descriptor^2descriptor^3descriptor^4d?scripteur^xDE ^uDE_^yDATABASE^mDE_
INDEX Cl=^1Clas.^2Clas.^3Class.^4Class.^xCL ^uCL_^yDATABASE^mCL_

[APPLY_GIZMO]


[FORMAT_NAME]

FORMAT standard.pft=^1defecto^2pformat padr?o^3default^4Defaut
FORMAT DEFAULT=standard.pft

[HELP_FORM]


[PREFERENCES]

AVAILABLE FORMS=F,B
SEND RESULT BY EMAIL=OFF
NAVIGATION BAR=OFF
DOCUMENTS PER PAGE=20
FEATURES=
