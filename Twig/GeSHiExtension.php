<?php
namespace maschit\CodingNightmares\WebsiteBundle\Twig;

class GeSHiExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            'geshi'  => new \Twig_Filter_Method($this, 'highlight'),
        );
    }

    public function highlight($code, $lang) {
        $g = new \GeSHi($code, $lang);
        $g->enable_classes();
        $g->set_header_type(GESHI_HEADER_DIV);
        $g->set_overall_class('code');
        $g->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
        return $g->parse_code();
        // @TODO: geshi as a twig extension (filter)
        // post.content|geshi(code.lang.name)
    }

    public function getName()
    {
        return 'geshi_extension';
    }

}