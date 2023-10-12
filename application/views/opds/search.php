<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
<ShortName>My catalog</ShortName>
<Description>Search for ebooks</Description>
<InputEncoding>UTF-8</InputEncoding>
<OutputEncoding>UTF-8</OutputEncoding>
<Image type="image/x-icon" width="16" height="16">favicon.ico</Image>
<Url type="application/atom+xml" template="<?php echo base_url('opds/search/{searchTerms}'); ?>" />
<Query role="example" searchTerms="robot"/>
</OpenSearchDescription>