This distribution of the beta-release of ABCD2.2 has the following caveats :

- Only the (new) Central and OPAC-ABCD modules are included, along with some new databases for these modules.
- otherwise the package contains the same cgi-bin folder with ANSI- and UTF8-subfolders as previous versions of ABCD2.x.
- The new OPAC needs a lot of configuration but contains a configuration script and online-help in many languages
(click on the HELP-button of the diagnostico.php script in the opac-abcd/conf folder
- the OPAC can more or less substiture the meta-search of the old ABCD Site/iAH combination : index-based searching of
multiple databases but with added functionality like merged indexes for all databases, configurable facets etc.
- so, in case in your particular case the ABCD Site/Admin no longer works fully, i.e. with missing parts in the menu's due to
incompatible underlying libraries of XSLT - as far as we know only in Windows -, then you could envisage using the OPAC instead.
- Secs-Web in more recent environments of PHP (esp. the Smarty library) also has problems, but most of its functionality,
i.e. managing journals and series-publications, can be done using Central with the databases for Secs-Web made available directly
using the normal Central database setup; the demo-databases are added in the folder bases/bases-secsweb.
- since this beta-release is mostly for existing users to test, just copy the folders in the package over the existing ones in
your current installation. It is advised to keep copies of your original files however.
- first, before testing Central, adjust the 'config.php.dist' file to reflect your local settings (consult the config.php of
your previous installation, mainly this entails the server URL).