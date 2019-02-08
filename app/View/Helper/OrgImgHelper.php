<?php
App::uses('AppHelper', 'View/Helper');

// Helper to retrieve org images with the given parameters
    class OrgImgHelper extends AppHelper {
        public function getOrgImg($options, $returnData = false) {
            $imgPath = APP . WEBROOT_DIR . DS . 'img' . DS . 'orgs' . DS;
            $imgOptions = array();
            $possibleFields = array('id', 'name');
            $size = !empty($options['size']) ? $options['size'] : 48;
            foreach ($possibleFields as $field) {
                if (isset($options[$field]) && file_exists($imgPath . $options[$field] . '.png')) {
                    $imgOptions[$field] = $options[$field] . '.png';
                    break;
                }
            }
            if (!empty($imgOptions)) {
                foreach ($imgOptions as $field => $imgOption) {
                    $result = sprintf(
                        '<a href="/organisations/view/%s"><img src="/img/orgs/%s" title = "%s" style = "width: %spx; height: %spx;"/>
                        </a>',
                        (empty($options['id']) ? h($options['name']) : h($options['id'])),
                        $imgOption,
                        isset($options['name']) ? h($options['name']) : h($options['id']),
                        h($size),
                        h($size)
                    );
                    break;
                }
            } else {
                $result = sprintf(
                    '<a href="/organisations/view/%s">\<span class="welcome" style="float:left">%s</span></a>',
                    (empty($options['id']) ? h($options['name']) : h($options['id'])),
                    h($options['name'])
                );
            }
            if ($returnData) {
                return $result;
            } else {
                echo $result;
            }
        }
    }
?>
