<?php
/**
 * countTrackula
 *
 * @package countTrackula
 * @author daemon.devin <daemon.devin@gmail.com>
 * @link PortableAppz.x10.mx/
 * @copyright 2019
 * @version 2.0
 * @access public
 */
class countTrackula {

  public $modx   = null;
  public $config = [];
  public $file;
  public $name;
  public $hash;
  public $link;
  public $algo;
  public $salt;
  public $isLink;
  public $types = [

    "ez"          => "application/andrew-inset",
    "aw"          => "application/applixware",
    "atom"        => "application/atom+xml",
    "atomcat"     => "application/atomcat+xml",
    "atomsvc"     => "application/atomsvc+xml",
    "ccxml"       => "application/ccxml+xml",
    "cu"          => "application/cu-seeme",
    "davmount"    => "application/davmount+xml",
    "dssc"        => "application/dssc+der",
    "xdssc"       => "application/dssc+xml",
    "ecma"        => "application/ecmascript",
    "emma"        => "application/emma+xml",
    "epub"        => "application/epub+zip",
    "pfr"         => "application/font-tdpfr",
    "stk"         => "application/hyperstudio",
    "ipfix"       => "application/ipfix",
    "jar"         => "application/java-archive",
    "ser"         => "application/java-serialized-object",
    "class"       => "application/java-vm",
    "js"          => "application/javascript",
    "json"        => "application/json",
    "lostxml"     => "application/lost+xml",
    "hqx"         => "application/mac-binhex40",
    "cpt"         => "application/mac-compactpro",
    "mrc"         => "application/marc",
    "ma"          => "application/mathematica",
    "nb"          => "application/mathematica",
    "mb"          => "application/mathematica",
    "mathml"      => "application/mathml+xml",
    "mbox"        => "application/mbox",
    "mscml"       => "application/mediaservercontrol+xml",
    "mp4s"        => "application/mp4",
    "doc"         => "application/msword",
    "dot"         => "application/msword",
    "mxf"         => "application/mxf",
    "bin"         => "application/octet-stream",
    "dms"         => "application/octet-stream",
    "lha"         => "application/octet-stream",
    "lrf"         => "application/octet-stream",
    "lzh"         => "application/octet-stream",
    "so"          => "application/octet-stream",
    "iso"         => "application/octet-stream",
    "dmg"         => "application/octet-stream",
    "dist"        => "application/octet-stream",
    "distz"       => "application/octet-stream",
    "pkg"         => "application/octet-stream",
    "bpk"         => "application/octet-stream",
    "dump"        => "application/octet-stream",
    "elc"         => "application/octet-stream",
    "deploy"      => "application/octet-stream",
    "oda"         => "application/oda",
    "opf"         => "application/oebps-package+xml",
    "ogx"         => "application/ogg",
    "onetoc"      => "application/onenote",
    "onetoc2"     => "application/onenote",
    "onetmp"      => "application/onenote",
    "onepkg"      => "application/onenote",
    "xer"         => "application/patch-ops-error+xml",
    "pdf"         => "application/pdf",
    "pgp"         => "application/pgp-encrypted",
    "asc"         => "application/pgp-signature",
    "sig"         => "application/pgp-signature",
    "prf"         => "application/pics-rules",
    "p10"         => "application/pkcs10",
    "p7m"         => "application/pkcs7-mime",
    "p7c"         => "application/pkcs7-mime",
    "p7s"         => "application/pkcs7-signature",
    "cer"         => "application/pkix-cert",
    "crl"         => "application/pkix-crl",
    "pkipath"     => "application/pkix-pkipath",
    "pki"         => "application/pkixcmp",
    "pls"         => "application/pls+xml",
    "ai"          => "application/postscript",
    "eps"         => "application/postscript",
    "ps"          => "application/postscript",
    "cww"         => "application/prs.cww",
    "rdf"         => "application/rdf+xml",
    "rif"         => "application/reginfo+xml",
    "rnc"         => "application/relax-ng-compact-syntax",
    "rl"          => "application/resource-lists+xml",
    "rld"         => "application/resource-lists-diff+xml",
    "rs"          => "application/rls-services+xml",
    "rsd"         => "application/rsd+xml",
    "rss"         => "application/rss+xml",
    "rtf"         => "application/rtf",
    "sbml"        => "application/sbml+xml",
    "scq"         => "application/scvp-cv-request",
    "scs"         => "application/scvp-cv-response",
    "spq"         => "application/scvp-vp-request",
    "spp"         => "application/scvp-vp-response",
    "sdp"         => "application/sdp",
    "setpay"      => "application/set-payment-initiation",
    "setreg"      => "application/set-registration-initiation",
    "shf"         => "application/shf+xml",
    "smi"         => "application/smil+xml",
    "smil"        => "application/smil+xml",
    "rq"          => "application/sparql-query",
    "srx"         => "application/sparql-results+xml",
    "gram"        => "application/srgs",
    "grxml"       => "application/srgs+xml",
    "ssml"        => "application/ssml+xml",
    "plb"         => "application/vnd.3gpp.pic-bw-large",
    "psb"         => "application/vnd.3gpp.pic-bw-small",
    "pvb"         => "application/vnd.3gpp.pic-bw-var",
    "tcap"        => "application/vnd.3gpp2.tcap",
    "pwn"         => "application/vnd.3m.post-it-notes",
    "aso"         => "application/vnd.accpac.simply.aso",
    "imp"         => "application/vnd.accpac.simply.imp",
    "acu"         => "application/vnd.acucobol",
    "atc"         => "application/vnd.acucorp",
    "acutc"       => "application/vnd.acucorp",
    "air"         => "application/vnd.adobe.air-application-installer-package+zip",
    "xdp"         => "application/vnd.adobe.xdp+xml",
    "xfdf"        => "application/vnd.adobe.xfdf",
    "azf"         => "application/vnd.airzip.filesecure.azf",
    "azs"         => "application/vnd.airzip.filesecure.azs",
    "azw"         => "application/vnd.amazon.ebook",
    "acc"         => "application/vnd.americandynamics.acc",
    "ami"         => "application/vnd.amiga.ami",
    "apk"         => "application/vnd.android.package-archive",
    "cii"         => "application/vnd.anser-web-certificate-issue-initiation",
    "fti"         => "application/vnd.anser-web-funds-transfer-initiation",
    "atx"         => "application/vnd.antix.game-component",
    "mpkg"        => "application/vnd.apple.installer+xml",
    "m3u8"        => "application/vnd.apple.mpegurl",
    "swi"         => "application/vnd.aristanetworks.swi",
    "aep"         => "application/vnd.audiograph",
    "mpm"         => "application/vnd.blueice.multipass",
    "bmi"         => "application/vnd.bmi",
    "rep"         => "application/vnd.businessobjects",
    "cdxml"       => "application/vnd.chemdraw+xml",
    "mmd"         => "application/vnd.chipnuts.karaoke-mmd",
    "cdy"         => "application/vnd.cinderella",
    "cla"         => "application/vnd.claymore",
    "rp9"         => "application/vnd.cloanto.rp9",
    "c4g"         => "application/vnd.clonk.c4group",
    "c4d"         => "application/vnd.clonk.c4group",
    "c4f"         => "application/vnd.clonk.c4group",
    "c4p"         => "application/vnd.clonk.c4group",
    "c4u"         => "application/vnd.clonk.c4group",
    "csp"         => "application/vnd.commonspace",
    "cdbcmsg"     => "application/vnd.contact.cmsg",
    "cmc"         => "application/vnd.cosmocaller",
    "clkx"        => "application/vnd.crick.clicker",
    "clkk"        => "application/vnd.crick.clicker.keyboard",
    "clkp"        => "application/vnd.crick.clicker.palette",
    "clkt"        => "application/vnd.crick.clicker.template",
    "clkw"        => "application/vnd.crick.clicker.wordbank",
    "wbs"         => "application/vnd.criticaltools.wbs+xml",
    "pml"         => "application/vnd.ctc-posml",
    "ppd"         => "application/vnd.cups-ppd",
    "car"         => "application/vnd.curl.car",
    "pcurl"       => "application/vnd.curl.pcurl",
    "rdz"         => "application/vnd.data-vision.rdz",
    "fe_launch"   => "application/vnd.denovo.fcselayout-link",
    "dna"         => "application/vnd.dna",
    "mlp"         => "application/vnd.dolby.mlp",
    "dpg"         => "application/vnd.dpgraph",
    "dfac"        => "application/vnd.dreamfactory",
    "geo"         => "application/vnd.dynageo",
    "mag"         => "application/vnd.ecowin.chart",
    "nml"         => "application/vnd.enliven",
    "esf"         => "application/vnd.epson.esf",
    "msf"         => "application/vnd.epson.msf",
    "qam"         => "application/vnd.epson.quickanime",
    "slt"         => "application/vnd.epson.salt",
    "ssf"         => "application/vnd.epson.ssf",
    "es3"         => "application/vnd.eszigno3+xml",
    "et3"         => "application/vnd.eszigno3+xml",
    "ez2"         => "application/vnd.ezpix-album",
    "ez3"         => "application/vnd.ezpix-package",
    "fdf"         => "application/vnd.fdf",
    "mseed"       => "application/vnd.fdsn.mseed",
    "seed"        => "application/vnd.fdsn.seed",
    "dataless"    => "application/vnd.fdsn.seed",
    "gph"         => "application/vnd.flographit",
    "ftc"         => "application/vnd.fluxtime.clip",
    "fm"          => "application/vnd.framemaker",
    "frame"       => "application/vnd.framemaker",
    "maker"       => "application/vnd.framemaker",
    "book"        => "application/vnd.framemaker",
    "fnc"         => "application/vnd.frogans.fnc",
    "ltf"         => "application/vnd.frogans.ltf",
    "fsc"         => "application/vnd.fsc.weblaunch",
    "oas"         => "application/vnd.fujitsu.oasys",
    "oa2"         => "application/vnd.fujitsu.oasys2",
    "oa3"         => "application/vnd.fujitsu.oasys3",
    "fg5"         => "application/vnd.fujitsu.oasysgp",
    "bh2"         => "application/vnd.fujitsu.oasysprs",
    "ddd"         => "application/vnd.fujixerox.ddd",
    "xdw"         => "application/vnd.fujixerox.docuworks",
    "xbd"         => "application/vnd.fujixerox.docuworks.binder",
    "fzs"         => "application/vnd.fuzzysheet",
    "txd"         => "application/vnd.genomatix.tuxedo",
    "ggb"         => "application/vnd.geogebra.file",
    "ggt"         => "application/vnd.geogebra.tool",
    "gex"         => "application/vnd.geometry-explorer",
    "gre"         => "application/vnd.geometry-explorer",
    "gxt"         => "application/vnd.geonext",
    "g2w"         => "application/vnd.geoplan",
    "g3w"         => "application/vnd.geospace",
    "gmx"         => "application/vnd.gmx",
    "kml"         => "application/vnd.google-earth.kml+xml",
    "kmz"         => "application/vnd.google-earth.kmz",
    "gqf"         => "application/vnd.grafeq",
    "gqs"         => "application/vnd.grafeq",
    "gac"         => "application/vnd.groove-account",
    "ghf"         => "application/vnd.groove-help",
    "gim"         => "application/vnd.groove-identity-message",
    "grv"         => "application/vnd.groove-injector",
    "gtm"         => "application/vnd.groove-tool-message",
    "tpl"         => "application/vnd.groove-tool-template",
    "vcg"         => "application/vnd.groove-vcard",
    "zmm"         => "application/vnd.handheld-entertainment+xml",
    "hbci"        => "application/vnd.hbci",
    "les"         => "application/vnd.hhe.lesson-player",
    "hpgl"        => "application/vnd.hp-hpgl",
    "hpid"        => "application/vnd.hp-hpid",
    "hps"         => "application/vnd.hp-hps",
    "jlt"         => "application/vnd.hp-jlyt",
    "pcl"         => "application/vnd.hp-pcl",
    "pclxl"       => "application/vnd.hp-pclxl",
    "sfd-hdstx"   => "application/vnd.hydrostatix.sof-data",
    "x3d"         => "application/vnd.hzn-3d-crossword",
    "mpy"         => "application/vnd.ibm.minipay",
    "afp"         => "application/vnd.ibm.modcap",
    "listafp"     => "application/vnd.ibm.modcap",
    "list3820"    => "application/vnd.ibm.modcap",
    "irm"         => "application/vnd.ibm.rights-management",
    "sc"          => "application/vnd.ibm.secure-container",
    "icc"         => "application/vnd.iccprofile",
    "icm"         => "application/vnd.iccprofile",
    "igl"         => "application/vnd.igloader",
    "ivp"         => "application/vnd.immervision-ivp",
    "ivu"         => "application/vnd.immervision-ivu",
    "xpw"         => "application/vnd.intercon.formnet",
    "xpx"         => "application/vnd.intercon.formnet",
    "qbo"         => "application/vnd.intu.qbo",
    "qfx"         => "application/vnd.intu.qfx",
    "rcprofile"   => "application/vnd.ipunplugged.rcprofile",
    "irp"         => "application/vnd.irepository.package+xml",
    "xpr"         => "application/vnd.is-xpr",
    "jam"         => "application/vnd.jam",
    "rms"         => "application/vnd.jcp.javame.midlet-rms",
    "jisp"        => "application/vnd.jisp",
    "joda"        => "application/vnd.joost.joda-archive",
    "ktz"         => "application/vnd.kahootz",
    "ktr"         => "application/vnd.kahootz",
    "karbon"      => "application/vnd.kde.karbon",
    "chrt"        => "application/vnd.kde.kchart",
    "kfo"         => "application/vnd.kde.kformula",
    "flw"         => "application/vnd.kde.kivio",
    "kon"         => "application/vnd.kde.kontour",
    "kpr"         => "application/vnd.kde.kpresenter",
    "kpt"         => "application/vnd.kde.kpresenter",
    "ksp"         => "application/vnd.kde.kspread",
    "kwd"         => "application/vnd.kde.kword",
    "kwt"         => "application/vnd.kde.kword",
    "htke"        => "application/vnd.kenameaapp",
    "kia"         => "application/vnd.kidspiration",
    "kne"         => "application/vnd.kinar",
    "knp"         => "application/vnd.kinar",
    "skp"         => "application/vnd.koan",
    "skd"         => "application/vnd.koan",
    "skt"         => "application/vnd.koan",
    "skm"         => "application/vnd.koan",
    "sse"         => "application/vnd.kodak-descriptor",
    "lbd"         => "application/vnd.llamagraphics.life-balance.desktop",
    "lbe"         => "application/vnd.llamagraphics.life-balance.exchange+xml",
    "123"         => "application/vnd.lotus-1-2-3",
    "apr"         => "application/vnd.lotus-approach",
    "pre"         => "application/vnd.lotus-freelance",
    "nsf"         => "application/vnd.lotus-notes",
    "org"         => "application/vnd.lotus-organizer",
    "scm"         => "application/vnd.lotus-screencam",
    "lwp"         => "application/vnd.lotus-wordpro",
    "portpkg"     => "application/vnd.macports.portpkg",
    "mcd"         => "application/vnd.mcd",
    "mc1"         => "application/vnd.medcalcdata",
    "cdkey"       => "application/vnd.mediastation.cdkey",
    "mwf"         => "application/vnd.mfer",
    "mfm"         => "application/vnd.mfmp",
    "flo"         => "application/vnd.micrografx.flo",
    "igx"         => "application/vnd.micrografx.igx",
    "mif"         => "application/vnd.mif",
    "daf"         => "application/vnd.mobius.daf",
    "dis"         => "application/vnd.mobius.dis",
    "mbk"         => "application/vnd.mobius.mbk",
    "mqy"         => "application/vnd.mobius.mqy",
    "msl"         => "application/vnd.mobius.msl",
    "plc"         => "application/vnd.mobius.plc",
    "txf"         => "application/vnd.mobius.txf",
    "mpn"         => "application/vnd.mophun.application",
    "mpc"         => "application/vnd.mophun.certificate",
    "xul"         => "application/vnd.mozilla.xul+xml",
    "cil"         => "application/vnd.ms-artgalry",
    "cab"         => "application/vnd.ms-cab-compressed",
    "xls"         => "application/vnd.ms-excel",
    "xlm"         => "application/vnd.ms-excel",
    "xla"         => "application/vnd.ms-excel",
    "xlc"         => "application/vnd.ms-excel",
    "xlt"         => "application/vnd.ms-excel",
    "xlw"         => "application/vnd.ms-excel",
    "xlam"        => "application/vnd.ms-excel.addin.macroenabled.12",
    "xlsb"        => "application/vnd.ms-excel.sheet.binary.macroenabled.12",
    "xlsm"        => "application/vnd.ms-excel.sheet.macroenabled.12",
    "xltm"        => "application/vnd.ms-excel.template.macroenabled.12",
    "eot"         => "application/vnd.ms-fontobject",
    "chm"         => "application/vnd.ms-htmlhelp",
    "ims"         => "application/vnd.ms-ims",
    "lrm"         => "application/vnd.ms-lrm",
    "cat"         => "application/vnd.ms-pki.seccat",
    "stl"         => "application/vnd.ms-pki.stl",
    "ppt"         => "application/vnd.ms-powerpoint",
    "pps"         => "application/vnd.ms-powerpoint",
    "pot"         => "application/vnd.ms-powerpoint",
    "ppam"        => "application/vnd.ms-powerpoint.addin.macroenabled.12",
    "pptm"        => "application/vnd.ms-powerpoint.presentation.macroenabled.12",
    "sldm"        => "application/vnd.ms-powerpoint.slide.macroenabled.12",
    "ppsm"        => "application/vnd.ms-powerpoint.slideshow.macroenabled.12",
    "potm"        => "application/vnd.ms-powerpoint.template.macroenabled.12",
    "mpp"         => "application/vnd.ms-project",
    "mpt"         => "application/vnd.ms-project",
    "docm"        => "application/vnd.ms-word.document.macroenabled.12",
    "dotm"        => "application/vnd.ms-word.template.macroenabled.12",
    "wps"         => "application/vnd.ms-works",
    "wks"         => "application/vnd.ms-works",
    "wcm"         => "application/vnd.ms-works",
    "wdb"         => "application/vnd.ms-works",
    "wpl"         => "application/vnd.ms-wpl",
    "xps"         => "application/vnd.ms-xpsdocument",
    "mseq"        => "application/vnd.mseq",
    "mus"         => "application/vnd.musician",
    "msty"        => "application/vnd.muvee.style",
    "nlu"         => "application/vnd.neurolanguage.nlu",
    "nnd"         => "application/vnd.noblenet-directory",
    "nns"         => "application/vnd.noblenet-sealer",
    "nnw"         => "application/vnd.noblenet-web",
    "ngdat"       => "application/vnd.nokia.n-gage.data",
    "n-gage"      => "application/vnd.nokia.n-gage.symbian.install",
    "rpst"        => "application/vnd.nokia.radio-preset",
    "rpss"        => "application/vnd.nokia.radio-presets",
    "edm"         => "application/vnd.novadigm.edm",
    "edx"         => "application/vnd.novadigm.edx",
    "ext"         => "application/vnd.novadigm.ext",
    "odc"         => "application/vnd.oasis.opendocument.chart",
    "otc"         => "application/vnd.oasis.opendocument.chart-template",
    "odb"         => "application/vnd.oasis.opendocument.database",
    "odf"         => "application/vnd.oasis.opendocument.formula",
    "odft"        => "application/vnd.oasis.opendocument.formula-template",
    "odg"         => "application/vnd.oasis.opendocument.graphics",
    "otg"         => "application/vnd.oasis.opendocument.graphics-template",
    "odi"         => "application/vnd.oasis.opendocument.image",
    "oti"         => "application/vnd.oasis.opendocument.image-template",
    "odp"         => "application/vnd.oasis.opendocument.presentation",
    "otp"         => "application/vnd.oasis.opendocument.presentation-template",
    "ods"         => "application/vnd.oasis.opendocument.spreadsheet",
    "ots"         => "application/vnd.oasis.opendocument.spreadsheet-template",
    "odt"         => "application/vnd.oasis.opendocument.text",
    "otm"         => "application/vnd.oasis.opendocument.text-master",
    "ott"         => "application/vnd.oasis.opendocument.text-template",
    "oth"         => "application/vnd.oasis.opendocument.text-web",
    "xo"          => "application/vnd.olpc-sugar",
    "dd2"         => "application/vnd.oma.dd2+xml",
    "oxt"         => "application/vnd.openofficeorg.extension",
    "pptx"        => "application/vnd.openxmlformats-officedocument.presentationml.presentation",
    "sldx"        => "application/vnd.openxmlformats-officedocument.presentationml.slide",
    "ppsx"        => "application/vnd.openxmlformats-officedocument.presentationml.slideshow",
    "potx"        => "application/vnd.openxmlformats-officedocument.presentationml.template",
    "xlsx"        => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    "xltx"        => "application/vnd.openxmlformats-officedocument.spreadsheetml.template",
    "docx"        => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "dotx"        => "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
    "dp"          => "application/vnd.osgi.dp",
    "pdb"         => "application/vnd.palm",
    "pqa"         => "application/vnd.palm",
    "oprc"        => "application/vnd.palm",
    "paw"         => "application/vnd.pawaafile",
    "str"         => "application/vnd.pg.format",
    "ei6"         => "application/vnd.pg.osasli",
    "efif"        => "application/vnd.picsel",
    "wg"          => "application/vnd.pmi.widget",
    "plf"         => "application/vnd.pocketlearn",
    "pbd"         => "application/vnd.powerbuilder6",
    "box"         => "application/vnd.previewsystems.box",
    "mgz"         => "application/vnd.proteus.magazine",
    "qps"         => "application/vnd.publishare-delta-tree",
    "ptid"        => "application/vnd.pvi.ptid1",
    "qxd"         => "application/vnd.quark.quarkxpress",
    "qxt"         => "application/vnd.quark.quarkxpress",
    "qwd"         => "application/vnd.quark.quarkxpress",
    "qwt"         => "application/vnd.quark.quarkxpress",
    "qxl"         => "application/vnd.quark.quarkxpress",
    "qxb"         => "application/vnd.quark.quarkxpress",
    "bed"         => "application/vnd.realvnc.bed",
    "mxl"         => "application/vnd.recordare.musicxml",
    "musicxml"    => "application/vnd.recordare.musicxml+xml",
    "cod"         => "application/vnd.rim.cod",
    "rm"          => "application/vnd.rn-realmedia",
    "link66"      => "application/vnd.route66.link66+xml",
    "st"          => "application/vnd.sailingtracker.track",
    "see"         => "application/vnd.seemail",
    "sema"        => "application/vnd.sema",
    "semd"        => "application/vnd.semd",
    "semf"        => "application/vnd.semf",
    "ifm"         => "application/vnd.shana.informed.formdata",
    "itp"         => "application/vnd.shana.informed.formtemplate",
    "iif"         => "application/vnd.shana.informed.interchange",
    "ipk"         => "application/vnd.shana.informed.package",
    "twd"         => "application/vnd.simtech-mindmapper",
    "twds"        => "application/vnd.simtech-mindmapper",
    "mmf"         => "application/vnd.smaf",
    "teacher"     => "application/vnd.smart.teacher",
    "sdkm"        => "application/vnd.solent.sdkm+xml",
    "sdkd"        => "application/vnd.solent.sdkm+xml",
    "dxp"         => "application/vnd.spotfire.dxp",
    "sfs"         => "application/vnd.spotfire.sfs",
    "sdc"         => "application/vnd.stardivision.calc",
    "sda"         => "application/vnd.stardivision.draw",
    "sdd"         => "application/vnd.stardivision.impress",
    "smf"         => "application/vnd.stardivision.math",
    "sdw"         => "application/vnd.stardivision.writer",
    "vor"         => "application/vnd.stardivision.writer",
    "sgl"         => "application/vnd.stardivision.writer-global",
    "sxc"         => "application/vnd.sun.xml.calc",
    "stc"         => "application/vnd.sun.xml.calc.template",
    "sxd"         => "application/vnd.sun.xml.draw",
    "std"         => "application/vnd.sun.xml.draw.template",
    "sxi"         => "application/vnd.sun.xml.impress",
    "sti"         => "application/vnd.sun.xml.impress.template",
    "sxm"         => "application/vnd.sun.xml.math",
    "sxw"         => "application/vnd.sun.xml.writer",
    "sxg"         => "application/vnd.sun.xml.writer.global",
    "stw"         => "application/vnd.sun.xml.writer.template",
    "sus"         => "application/vnd.sus-calendar",
    "susp"        => "application/vnd.sus-calendar",
    "svd"         => "application/vnd.svd",
    "sis"         => "application/vnd.symbian.install",
    "sisx"        => "application/vnd.symbian.install",
    "xsm"         => "application/vnd.syncml+xml",
    "bdm"         => "application/vnd.syncml.dm+wbxml",
    "xdm"         => "application/vnd.syncml.dm+xml",
    "tao"         => "application/vnd.tao.intent-module-archive",
    "tmo"         => "application/vnd.tmobile-livetv",
    "tpt"         => "application/vnd.trid.tpt",
    "mxs"         => "application/vnd.triscape.mxs",
    "tra"         => "application/vnd.trueapp",
    "ufd"         => "application/vnd.ufdl",
    "ufdl"        => "application/vnd.ufdl",
    "utz"         => "application/vnd.uiq.theme",
    "umj"         => "application/vnd.umajin",
    "unityweb"    => "application/vnd.unity",
    "uoml"        => "application/vnd.uoml+xml",
    "vcx"         => "application/vnd.vcx",
    "vsd"         => "application/vnd.visio",
    "vst"         => "application/vnd.visio",
    "vss"         => "application/vnd.visio",
    "vsw"         => "application/vnd.visio",
    "vis"         => "application/vnd.visionary",
    "vsf"         => "application/vnd.vsf",
    "wbxml"       => "application/vnd.wap.wbxml",
    "wmlc"        => "application/vnd.wap.wmlc",
    "wmlsc"       => "application/vnd.wap.wmlscriptc",
    "wtb"         => "application/vnd.webturbo",
    "nbp"         => "application/vnd.wolfram.player",
    "wpd"         => "application/vnd.wordperfect",
    "wqd"         => "application/vnd.wqd",
    "stf"         => "application/vnd.wt.stf",
    "xar"         => "application/vnd.xara",
    "xfdl"        => "application/vnd.xfdl",
    "hvd"         => "application/vnd.yamaha.hv-dic",
    "hvs"         => "application/vnd.yamaha.hv-script",
    "hvp"         => "application/vnd.yamaha.hv-voice",
    "osf"         => "application/vnd.yamaha.openscoreformat",
    "osfpvg"      => "application/vnd.yamaha.openscoreformat.osfpvg+xml",
    "saf"         => "application/vnd.yamaha.smaf-audio",
    "spf"         => "application/vnd.yamaha.smaf-phrase",
    "cmp"         => "application/vnd.yellowriver-custom-menu",
    "zir"         => "application/vnd.zul",
    "zirz"        => "application/vnd.zul",
    "zaz"         => "application/vnd.zzazz.deck+xml",
    "vxml"        => "application/voicexml+xml",
    "hlp"         => "application/winhlp",
    "wsdl"        => "application/wsdl+xml",
    "wspolicy"    => "application/wspolicy+xml",
    "abw"         => "application/x-abiword",
    "ace"         => "application/x-ace-compressed",
    "aab"         => "application/x-authorware-bin",
    "x32"         => "application/x-authorware-bin",
    "u32"         => "application/x-authorware-bin",
    "vox"         => "application/x-authorware-bin",
    "aam"         => "application/x-authorware-map",
    "aas"         => "application/x-authorware-seg",
    "bcpio"       => "application/x-bcpio",
    "torrent"     => "application/x-bittorrent",
    "bz"          => "application/x-bzip",
    "bz2"         => "application/x-bzip2",
    "boz"         => "application/x-bzip2",
    "vcd"         => "application/x-cdlink",
    "chat"        => "application/x-chat",
    "pgn"         => "application/x-chess-pgn",
    "cpio"        => "application/x-cpio",
    "csh"         => "application/x-csh",
    "deb"         => "application/x-debian-package",
    "udeb"        => "application/x-debian-package",
    "dir"         => "application/x-director",
    "dcr"         => "application/x-director",
    "dxr"         => "application/x-director",
    "cst"         => "application/x-director",
    "cct"         => "application/x-director",
    "cxt"         => "application/x-director",
    "w3d"         => "application/x-director",
    "fgd"         => "application/x-director",
    "swa"         => "application/x-director",
    "wad"         => "application/x-doom",
    "ncx"         => "application/x-dtbncx+xml",
    "dtb"         => "application/x-dtbook+xml",
    "res"         => "application/x-dtbresource+xml",
    "dvi"         => "application/x-dvi",
    "bdf"         => "application/x-font-bdf",
    "gsf"         => "application/x-font-ghostscript",
    "psf"         => "application/x-font-linux-psf",
    "otf"         => "application/x-font-otf",
    "pcf"         => "application/x-font-pcf",
    "snf"         => "application/x-font-snf",
    "ttf"         => "application/x-font-ttf",
    "ttc"         => "application/x-font-ttf",
    "pfa"         => "application/x-font-type1",
    "pfb"         => "application/x-font-type1",
    "pfm"         => "application/x-font-type1",
    "afm"         => "application/x-font-type1",
    "spl"         => "application/x-futuresplash",
    "gnumeric"    => "application/x-gnumeric",
    "gtar"        => "application/x-gtar",
    "hdf"         => "application/x-hdf",
    "jnlp"        => "application/x-java-jnlp-file",
    "latex"       => "application/x-latex",
    "prc"         => "application/x-mobipocket-ebook",
    "mobi"        => "application/x-mobipocket-ebook",
    "application" => "application/x-ms-application",
    "wmd"         => "application/x-ms-wmd",
    "wmz"         => "application/x-ms-wmz",
    "xbap"        => "application/x-ms-xbap",
    "mdb"         => "application/x-msaccess",
    "obd"         => "application/x-msbinder",
    "crd"         => "application/x-mscardfile",
    "clp"         => "application/x-msclip",
    "exe"         => "application/x-msdownload",
    "dll"         => "application/x-msdownload",
    "com"         => "application/x-msdownload",
    "bat"         => "application/x-msdownload",
    "msi"         => "application/x-msdownload",
    "mvb"         => "application/x-msmediaview",
    "m13"         => "application/x-msmediaview",
    "m14"         => "application/x-msmediaview",
    "wmf"         => "application/x-msmetafile",
    "mny"         => "application/x-msmoney",
    "pub"         => "application/x-mspublisher",
    "scd"         => "application/x-msschedule",
    "trm"         => "application/x-msterminal",
    "wri"         => "application/x-mswrite",
    "nc"          => "application/x-netcdf",
    "cdf"         => "application/x-netcdf",
    "p12"         => "application/x-pkcs12",
    "pfx"         => "application/x-pkcs12",
    "p7b"         => "application/x-pkcs7-certificates",
    "spc"         => "application/x-pkcs7-certificates",
    "p7r"         => "application/x-pkcs7-certreqresp",
    "rar"         => "application/x-rar-compressed",
    "sh"          => "application/x-sh",
    "shar"        => "application/x-shar",
    "swf"         => "application/x-shockwave-flash",
    "xap"         => "application/x-silverlight-app",
    "sit"         => "application/x-stuffit",
    "sitx"        => "application/x-stuffitx",
    "sv4cpio"     => "application/x-sv4cpio",
    "sv4crc"      => "application/x-sv4crc",
    "tar"         => "application/x-tar",
    "tcl"         => "application/x-tcl",
    "tex"         => "application/x-tex",
    "tfm"         => "application/x-tex-tfm",
    "texinfo"     => "application/x-texinfo",
    "texi"        => "application/x-texinfo",
    "ustar"       => "application/x-ustar",
    "src"         => "application/x-wais-source",
    "der"         => "application/x-x509-ca-cert",
    "crt"         => "application/x-x509-ca-cert",
    "fig"         => "application/x-xfig",
    "xpi"         => "application/x-xpinstall",
    "xenc"        => "application/xenc+xml",
    "xhtml"       => "application/xhtml+xml",
    "xht"         => "application/xhtml+xml",
    "xml"         => "application/xml",
    "xsl"         => "application/xml",
    "dtd"         => "application/xml-dtd",
    "xop"         => "application/xop+xml",
    "xslt"        => "application/xslt+xml",
    "xspf"        => "application/xspf+xml",
    "mxml"        => "application/xv+xml",
    "xhvml"       => "application/xv+xml",
    "xvml"        => "application/xv+xml",
    "xvm"         => "application/xv+xml",
    "zip"         => "application/zip",
    "adp"         => "audio/adpcm",
    "au"          => "audio/basic",
    "snd"         => "audio/basic",
    "mid"         => "audio/midi",
    "midi"        => "audio/midi",
    "kar"         => "audio/midi",
    "rmi"         => "audio/midi",
    "mp4a"        => "audio/mp4",
    "mpga"        => "audio/mpeg",
    "mp2"         => "audio/mpeg",
    "mp2a"        => "audio/mpeg",
    "mp3"         => "audio/mpeg",
    "m2a"         => "audio/mpeg",
    "m3a"         => "audio/mpeg",
    "oga"         => "audio/ogg",
    "ogg"         => "audio/ogg",
    "spx"         => "audio/ogg",
    "eol"         => "audio/vnd.digital-winds",
    "dra"         => "audio/vnd.dra",
    "dts"         => "audio/vnd.dts",
    "dtshd"       => "audio/vnd.dts.hd",
    "lvp"         => "audio/vnd.lucent.voice",
    "pya"         => "audio/vnd.ms-playready.media.pya",
    "ecelp4800"   => "audio/vnd.nuera.ecelp4800",
    "ecelp7470"   => "audio/vnd.nuera.ecelp7470",
    "ecelp9600"   => "audio/vnd.nuera.ecelp9600",
    "aac"         => "audio/x-aac",
    "aif"         => "audio/x-aiff",
    "aiff"        => "audio/x-aiff",
    "aifc"        => "audio/x-aiff",
    "m3u"         => "audio/x-mpegurl",
    "wax"         => "audio/x-ms-wax",
    "wma"         => "audio/x-ms-wma",
    "ram"         => "audio/x-pn-realaudio",
    "ra"          => "audio/x-pn-realaudio",
    "rmp"         => "audio/x-pn-realaudio-plugin",
    "wav"         => "audio/x-wav",
    "cdx"         => "chemical/x-cdx",
    "cif"         => "chemical/x-cif",
    "cmdf"        => "chemical/x-cmdf",
    "cml"         => "chemical/x-cml",
    "csml"        => "chemical/x-csml",
    "xyz"         => "chemical/x-xyz",
    "bmp"         => "image/bmp",
    "cgm"         => "image/cgm",
    "g3"          => "image/g3fax",
    "gif"         => "image/gif",
    "ief"         => "image/ief",
    "jpeg"        => "image/jpeg",
    "jpg"         => "image/jpeg",
    "jpe"         => "image/jpeg",
    "png"         => "image/png",
    "btif"        => "image/prs.btif",
    "svg"         => "image/svg+xml",
    "svgz"        => "image/svg+xml",
    "tiff"        => "image/tiff",
    "tif"         => "image/tiff",
    "psd"         => "image/vnd.adobe.photoshop",
    "djvu"        => "image/vnd.djvu",
    "djv"         => "image/vnd.djvu",
    "dwg"         => "image/vnd.dwg",
    "dxf"         => "image/vnd.dxf",
    "fbs"         => "image/vnd.fastbidsheet",
    "fpx"         => "image/vnd.fpx",
    "fst"         => "image/vnd.fst",
    "mmr"         => "image/vnd.fujixerox.edmics-mmr",
    "rlc"         => "image/vnd.fujixerox.edmics-rlc",
    "mdi"         => "image/vnd.ms-modi",
    "npx"         => "image/vnd.net-fpx",
    "wbmp"        => "image/vnd.wap.wbmp",
    "xif"         => "image/vnd.xiff",
    "ras"         => "image/x-cmu-raster",
    "cmx"         => "image/x-cmx",
    "fh"          => "image/x-freehand",
    "fhc"         => "image/x-freehand",
    "fh4"         => "image/x-freehand",
    "fh5"         => "image/x-freehand",
    "fh7"         => "image/x-freehand",
    "ico"         => "image/x-icon",
    "pcx"         => "image/x-pcx",
    "pic"         => "image/x-pict",
    "pct"         => "image/x-pict",
    "pnm"         => "image/x-portable-anymap",
    "pbm"         => "image/x-portable-bitmap",
    "pgm"         => "image/x-portable-graymap",
    "ppm"         => "image/x-portable-pixmap",
    "rgb"         => "image/x-rgb",
    "xbm"         => "image/x-xbitmap",
    "xpm"         => "image/x-xpixmap",
    "xwd"         => "image/x-xwindowdump",
    "eml"         => "message/rfc822",
    "mime"        => "message/rfc822",
    "igs"         => "model/iges",
    "iges"        => "model/iges",
    "msh"         => "model/mesh",
    "mesh"        => "model/mesh",
    "silo"        => "model/mesh",
    "dwf"         => "model/vnd.dwf",
    "gdl"         => "model/vnd.gdl",
    "gtw"         => "model/vnd.gtw",
    "mts"         => "model/vnd.mts",
    "vtu"         => "model/vnd.vtu",
    "wrl"         => "model/vrml",
    "vrml"        => "model/vrml",
    "ics"         => "text/calendar",
    "ifb"         => "text/calendar",
    "css"         => "text/css",
    "csv"         => "text/csv",
    "html"        => "text/html",
    "htm"         => "text/html",
    "txt"         => "text/plain",
    "text"        => "text/plain",
    "conf"        => "text/plain",
    "def"         => "text/plain",
    "list"        => "text/plain",
    "log"         => "text/plain",
    "in"          => "text/plain",
    "dsc"         => "text/prs.lines.tag",
    "rtx"         => "text/richtext",
    "sgml"        => "text/sgml",
    "sgm"         => "text/sgml",
    "tsv"         => "text/tab-separated-values",
    "t"           => "text/troff",
    "tr"          => "text/troff",
    "roff"        => "text/troff",
    "man"         => "text/troff",
    "me"          => "text/troff",
    "ms"          => "text/troff",
    "uri"         => "text/uri-list",
    "uris"        => "text/uri-list",
    "urls"        => "text/uri-list",
    "curl"        => "text/vnd.curl",
    "dcurl"       => "text/vnd.curl.dcurl",
    "scurl"       => "text/vnd.curl.scurl",
    "mcurl"       => "text/vnd.curl.mcurl",
    "fly"         => "text/vnd.fly",
    "flx"         => "text/vnd.fmi.flexstor",
    "gv"          => "text/vnd.graphviz",
    "3dml"        => "text/vnd.in3d.3dml",
    "spot"        => "text/vnd.in3d.spot",
    "jad"         => "text/vnd.sun.j2me.app-descriptor",
    "wml"         => "text/vnd.wap.wml",
    "wmls"        => "text/vnd.wap.wmlscript",
    "s"           => "text/x-asm",
    "asm"         => "text/x-asm",
    "c"           => "text/x-c",
    "cc"          => "text/x-c",
    "cxx"         => "text/x-c",
    "cpp"         => "text/x-c",
    "h"           => "text/x-c",
    "hh"          => "text/x-c",
    "dic"         => "text/x-c",
    "f"           => "text/x-fortran",
    "for"         => "text/x-fortran",
    "f77"         => "text/x-fortran",
    "f90"         => "text/x-fortran",
    "p"           => "text/x-pascal",
    "pas"         => "text/x-pascal",
    "java"        => "text/x-java-source",
    "etx"         => "text/x-setext",
    "uu"          => "text/x-uuencode",
    "vcs"         => "text/x-vcalendar",
    "vcf"         => "text/x-vcard",
    "3gp"         => "video/3gpp",
    "3g2"         => "video/3gpp2",
    "h261"        => "video/h261",
    "h263"        => "video/h263",
    "h264"        => "video/h264",
    "jpgv"        => "video/jpeg",
    "jpm"         => "video/jpm",
    "jpgm"        => "video/jpm",
    "mj2"         => "video/mj2",
    "mjp2"        => "video/mj2",
    "mp4"         => "video/mp4",
    "mp4v"        => "video/mp4",
    "mpg4"        => "video/mp4",
    "mpeg"        => "video/mpeg",
    "mpg"         => "video/mpeg",
    "mpe"         => "video/mpeg",
    "m1v"         => "video/mpeg",
    "m2v"         => "video/mpeg",
    "ogv"         => "video/ogg",
    "qt"          => "video/quicktime",
    "mov"         => "video/quicktime",
    "fvt"         => "video/vnd.fvt",
    "mxu"         => "video/vnd.mpegurl",
    "m4u"         => "video/vnd.mpegurl",
    "pyv"         => "video/vnd.ms-playready.media.pyv",
    "viv"         => "video/vnd.vivo",
    "f4v"         => "video/x-f4v",
    "fli"         => "video/x-fli",
    "flv"         => "video/x-flv",
    "m4v"         => "video/x-m4v",
    "asf"         => "video/x-ms-asf",
    "asx"         => "video/x-ms-asf",
    "wm"          => "video/x-ms-wm",
    "wmv"         => "video/x-ms-wmv",
    "wmx"         => "video/x-ms-wmx",
    "wvx"         => "video/x-ms-wvx",
    "avi"         => "video/x-msvideo",
    "movie"       => "video/x-sgi-movie",
    "ice"         => "x-conference/x-cooltalk"
  ];

  /**
   * countTrackula constructor
   *
   * @param modX  &$modx   A reference to the modX instance.
   * @param array $config  An array of configuration options. Optional.
   */
  function __construct(modX &$modx, array $config = []) {
    $this->modx = &$modx;

    $corePath = $this->modx->getOption('counttrackula.core_path', null, MODX_CORE_PATH . 'components/counttrackula/');

    if (!empty($this->modx->getOption('salt'))) {
      $this->salt = $this->modx->getOption('salt', $scriptProperties);
    } else {
      $this->salt = $this->modx->getOption('counttrackula.salt',null);
    }

    $this->tpl  = $this->modx->getOption('tpl', $scriptProperties, 'downloadLinkTpl');
    $this->term = $this->modx->getOption('term', $scriptProperties);

    $this->config = array_merge([
      'corePath' => $corePath,
      'modelPath' => $corePath . 'model/',
      'chunksPath' => $corePath . 'elements/chunks/',
      'snippetsPath' => $corePath . 'elements/snippets/',

      'salt' => $this->salt,
    ], $config);

    $this->modx->addPackage('counttrackula',$this->config['modelPath']);

    $vicitim = $modx->newQuery('Victims', array(
        'path'   => $this->filepath
    ));
    if (!$vicitim) {
      $manager = $this->modx->getManager();
      $this->modx->setLogLevel(modX::LOG_LEVEL_ERROR);
      $manager->createObjectContainer('Victims');
      $this->modx->setLogLevel(modX::LOG_LEVEL_INFO);
    }
  }

  /**
   * Gets a Chunk and caches it; also falls back to file-based templates
   * for easier debugging.
   *
   * @param  string $name The name of the Chunk
   * @param  array  $properties The properties for the Chunk
   * @return string The processed content of the Chunk
   * @access public
   */
  public function getChunk($name, $properties = [], $suffix = '.chunk.tpl') {
    $chunk = null;
    if (!isset($this->chunks[$name])) {
      $chunk = $this->modx->getObject('modChunk', ['name' => $name], true);
      if (empty($chunk)) {
        $chunk = $this->_getTplChunk($name, $suffix);
        if ($chunk == false) {
          return false;
        }

      }
      $this->chunks[$name] = $chunk->getContent();
    } else {
      $o     = $this->chunks[$name];
      $chunk = $this->modx->newObject('modChunk');
      $chunk->setContent($o);
    }
    $chunk->setCacheable(false);
    return $chunk->process($properties);
  }

  /**
   * Returns a modChunk object from a template file.
   *
   * @param  string $name The name of the Chunk. Will parse to name.chunk.tpl
   * @return modChunk/boolean Returns the modChunk object if found, otherwise false
   * @access private
   */
  private function _getTplChunk($name, $suffix = '.chunk.tpl') {
    $chunk = false;
    $f     = $this->config['chunksPath'] . strtolower($name) . $suffix;
    if (file_exists($f)) {
      $o     = file_get_contents($f);
      $chunk = $this->modx->newObject('modChunk');
      $chunk->set('name', $name);
      $chunk->setContent($o);
    }
    return $chunk;
  }

  /**
   * Sets a value to a defined key
   *
   * @param  string $key
   * @param  string $value
   * @return void
   * @access public
   */
  public function _set($key, $value) {
    $this->$key = $value;
  }

  /**
   * Grabs a property and returns its value
   *
   * @param  string $key
   * @param  string $value
   * @return void
   * @access public
   */
  public function _get($key) {
    return $this->$key;
  }

  /**
   * Generates a salted hash from the supplied data using the specified algorithm.
   * Defaults to using SHA1 if no algorthm is specified.
   *
   * @param  string $data
   * @param  string $algo
   * @return string
   * @access public
   */
  public function generateHash($data, $algo = null) {
    if (!is_null($algo)) {
      $algos = hash_hmac_algos();
      if (!in_array($algo, $algos)) {
        $err = "[" . __CLASS__ . "] {$algo} is not a supported hashing algorithm!";
        $this->modx->log(modX::LOG_LEVEL_ERROR, $err);
        throw new Exception($err);
      } else {
        $this->algo = $algo;
      }
    } else {
      $this->algo = $this->modx->getOption('counttrackula.algo',null,'sha1');
    }
    if (empty($data)) {
      $err = "[" . __CLASS__ . "] Cannot hash an empty string!";
      $this->modx->log(modX::LOG_LEVEL_ERROR, $err);
      throw new Exception($err);
    } else {
      $hash = hash_hmac($this->algo, $data, $this->config['salt']);
      $hash = strtoupper($hash);
      return $hash;
    }
  }

  /**
   * Compares two hashes using the pre-defined algorithm.
   *
   * @param  string  $hash
   * @param  string  $data
   * @return mixed
   * @access public
   */
  public function compareHash($hash, $data) {
    $hash_checksum = $this->generateHash($data);
    if ($this->hashEquals($hash_checksum, $hash)) {
      return $data;
    } else {
      return false;
    }
  }

  /**
   * Timing attack safe string comparison. Compares two strings using the same time
   * whether they're equal or not. Might be overkill for what I'm using it for but
   * you can never be too safe?
   *
   * @param  string  $knownHash The string of known length to compare against
   * @param  string  $checkHash The string to check agaisnt
   * @return boolean
   * @access public
   */
  public function hashEquals($knownHash, $checkHash) {
    $ret = 0;
    if (strlen($knownHash) !== strlen($checkHash)) {
      $checkHash = $knownHash;
      $ret       = 1;
    }
    $res = $knownHash ^ $checkHash;
    for ($i = strlen($res) - 1; $i >= 0; --$i) {
      $ret |= ord($res[$i]);
    }
    return !$ret;
  }

  /**
   * Sends a file to the client's browser for download.
   *
   * @param  string     $file
   * @param  boolean    $inline
   * @return void
   * @access public
   */
  public function outputFile($file, $inline) {

    $filesize  = filesize($file);
    $basename   = basename($file);

    if (!$mimetype && function_exists("finfo_open")) {
      $finfo    = new finfo(FILEINFO_MIME_TYPE);
      $mimetype = $finfo->file($file);
      if ($mimetype == "application/octet-stream") {
        $mimetype = null;
      }
    }
    if (!$mimetype && function_exists("mime_content_type")) {
      $mimetype = mime_content_type($file);
      if ($mimetype == "application/octet-stream") {
        $mimetype = null;
      }
    }
    if (!$mimetype) {
      $mimetype = $this->guess($file);
    }
    // If we're here then octet-stream
    // deserves the property value
    if (!$mimetype) {
      $mimetype = "application/octet-stream";
    }

    if (is_file($file)) {
      $file      = @fopen($file, "rb");
      if ($file) {

        header("Pragma: public");
        header("Expires: -1");
        header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: {$mimetype}");
        header("Content-Length: {$filesize}");

        if ($inline !== null) {
          if (!$inline === true) {
            header("Content-Disposition: attachment; filename=\"{$basename}\"");
          } else {
            header("Content-Disposition: inline;");
          }

        }

        if (isset($_SERVER['HTTP_RANGE'])) {
          list($size_unit, $range_orig) = explode('=', $_SERVER['HTTP_RANGE'], 2);
          if ($size_unit == 'bytes') {
            // multiple ranges could be specified at the same time, but for simplicity only serve the first range
            // http://tools.ietf.org/id/draft-ietf-http-range-retrieval-00.txt
            list($range, $extra_ranges) = explode(',', $range_orig, 2);
          } else {
            $range = '';
            header("HTTP/1.1 416 Requested Range Not Satisfiable");
            $err = "[" . __CLASS__ . "] Requested range not satisfiable!";
            $this->modx->log(modX::LOG_LEVEL_ERROR, $err);
            throw new Exception($err);
          }
        } else {
          $range = '';
        }
        list($seek_start, $seek_end) = explode('-', $range, 2);
        $seek_end                    = (empty($seek_end)) ? ($filesize - 1) : min(abs(intval($seek_end)), ($filesize - 1));
        $seek_start                  = (empty($seek_start) || $seek_end < abs(intval($seek_start))) ? 0 : max(abs(intval($seek_start)), 0);
        if ($seek_start > 0 || $seek_end < ($filesize - 1)) {
          header('HTTP/1.1 206 Partial Content');
          header('Content-Range: bytes ' . $seek_start . '-' . $seek_end . '/' . $filesize);
          header('Content-Length: ' . ($seek_end - $seek_start + 1));
        } else {
          header("Content-Length: $filesize");
        }

        header('Accept-Ranges: bytes');

        set_time_limit(0);
        fseek($file, $seek_start);

        while (!feof($file)) {
          print(@fread($file, 1024 * 8));
          ob_flush();
          flush();
          if (connection_status() != 0) {
            @fclose($file);
          }
        }
        @fclose($file);
      } else {
        $err = "[" . __CLASS__ . "] Cannot read file for transfer!";
        $this->modx->log(modX::LOG_LEVEL_ERROR, $err);
        throw new Exception($err);
      }
    } else {
      $err = "[" . __CLASS__ . "] Cannot locate file for transfer!";
      $this->modx->log(modX::LOG_LEVEL_ERROR, $err);
      throw new Exception($err);
    }
  }

  /**
   * Creates a link containing a hash of the download file
   *
   * @param   string   $hash The hash to use with the link
   * @param   boolean  $link True means the download is a remote file
   * @return  string
   * @access  public
   */
  public function generateLink($hash) {
    $output      = '';
    $query  = $this->modx->request->getParameters();
    $url    = $this->modx->makeUrl($this->modx->resource->get('id'), '', modX::toQueryString($query),'full');
    $output = "{$url}?download={$hash}" . ($this->isLink === true ? '&link=' . $this->link : '');
    return $output;
  }

  /**
   * Quick and dirty way to check to see if the URL exists by checking if there
   * is a DNS entry for the supplied URL.
   *
   * @param  string   $url  URL to check existence of
   * @return boolean
   * @access public
   */
  public function urlExists($url) {
    $result = false;
    @$dns   = parse_url($url);
    @$dns   = dns_get_record($dns['host']);
    if (@$dns[0]) {
      $result = true;
    }
    return $result;
  }

  /**
   * Checks the validity of a given URL
   *
   * @param  string   $url  URL to check the validity of
   * @return boolean
   * @access public
   */
  public function validURL($url) {
    if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
      return true;
    }
  }

  /**
   * Grabs the remote IP address of the client.
   *
   * @return string
   * @access private
   */
  public function clientIP() {
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
      $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    };
    foreach ([
      'HTTP_CLIENT_IP',
      'HTTP_X_FORWARDED_FOR',
      'HTTP_X_FORWARDED',
      'HTTP_X_CLUSTER_CLIENT_IP',
      'HTTP_FORWARDED_FOR',
      'HTTP_FORWARDED',
      'REMOTE_ADDR'
    ] as $key) {
      if (array_key_exists($key, $_SERVER)) {
        foreach (explode(',', $_SERVER[$key]) as $ip) {
          $ip = trim($ip);
          if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
            return $ip;
          };
        };
      };
    };
    return false;
  }

  /**
   * Get the file size of any remote resource as human-readable formatted string.
   * NOT IMPLEMENTED
   *
   * @param  string   $url          Takes the remote object's URL.
   * @param  boolean  $useHead      Whether to use HEAD requests. If false, uses GET.
   * @return  string
   * @access private
   */
  private function getRemoteFilesize($url, bool $useHead = true) {
    if ($useHead !== false) {
      stream_context_set_default(['http' => ['method' => 'HEAD']]);
    }
    $head = array_change_key_case(get_headers($url, 1));
    // content-length of download (in bytes), read from Content-Length: field
    $clen = isset($head['content-length']) ? $head['content-length'] : 0;

    // cannot retrieve file size, return "-1"
    if (!$clen) {
      return -1;
    }

    if (!$formatSize) {
      return $clen; // return size in bytes
    }

    $size = $clen;
    switch ($clen) {
      case $clen < 1024:
        $size = $clen . ' B';
        break;
      case $clen < 1048576:
        $size = round($clen / 1024, 2) . ' KiB';
        break;
      case $clen < 1073741824:
        $size = round($clen / 1048576, 2) . ' MiB';
        break;
      case $clen < 1099511627776:
        $size = round($clen / 1073741824, 2) . ' GiB';
        break;
    }

    return $size;
  }

  /**
   * Send HTTP Headers for given file
   *
   * @param  string $file    path to file to determine mimetype of
   * @param  bool   $inline  true: inline, false: attachment, null: no disposition headers
   * @return void
   * @access public
   */
  public function header($file, bool $inline = null) {
    $mimetype = self::get($file);
    $size     = filesize($file);
    $basename = basename($file);

    header("Pragma: public");
    header("Expires: -1");
    header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: {$mimetype}");
    header("Content-Length: {$size}");

    if ($inline !== null) {
      if (!$inline === true) {
        header("Content-Disposition: attachment; filename=\"{$basename}\"");
      } else {
        header("Content-Disposition: inline;");
      }

    }
  }

  /**
   * Guess the Mimetype of a filename (based on its file extension)
   *
   * @param  string $file
   * @return string mimetype of given file
   * @access public
   */
  public function guess($file) {
    if ($pos = strrpos($file, '.')) {
      $extension = strtolower(substr($file, $pos + 1));
      if (!empty(types[$extension])) {
        return types[$extension];
      }
    }

    return null;
  }

}
