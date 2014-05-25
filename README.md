plg_system_relcanon_althost
===========================

Joomla plugin that sets the rel canonical meta tag to another hostname

# Description
Sets the rel canonical link tag to another hostname. Useful for SEO to prevent dup content penalty when content is identical to another URL with a different hostname. Be sure to edit the configuration and set the alternate hostname before enabling the plugin. For example, if the rel canonical url was http://foo.tld/blah and you set the alt host to bar.tld, the new rel canonical will be http://bar.tld/blah.  There is also an option for using WP search query style. If enabled, the resulting rel canonical would be http://bar.tld/?s=blah

# How to use

The most simple way is to Download Zip and then upload that to the Joomla Extension Manager under Upload Package File.  Then visit the Plugin Manager, find the "System - Rel Canonical Alt Host" plugin, click on it, set the Alt Host and consider the Use WP Search option.  Change status to Enabled and Save.

Visit regular pages of your site, view source, and notice the updated &lt;link href="http://bar.tld/" rel="canonical" /&gt; links in the &lt;head&gt;.
