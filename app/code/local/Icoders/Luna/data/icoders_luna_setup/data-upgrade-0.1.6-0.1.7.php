<?php
/**
 * Icoders Luna - Demo CMS Page
 *
 * @category  Icoders
 * @package   Icoders_Luna
 * @author    Kovacs Daniel Akos <kovacs.daniel@icoders.co>
 * @copyright 2002-2016. Icoders (http://www.icoders.co)
 * @license   http://www.magentocommerce.com/license/enterprise-edition GNU General Public License
 * @link      http://www.icoders.co
 */

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;
$installer->startSetup();

try {
    $identifier = 'demo-cms-oldal';
    $staticBlock = Mage::getModel('cms/page')
        ->load($identifier, 'identifier');

    if ($staticBlock->isObjectNew()) {
        $staticBlock
            ->setIdentifier($identifier)
            ->setStores(array(0))
            ->setIsActive(true)
            ->setTitle('Demo Homepage');
    }

    $content =
        "<p>I took this vo-tech class in high school, woodworking. I took a lot of vo-tech classes, because it was just big jerk-off, but this one time I had this teacher by the name of... Mr... Mr. Pike. I guess he was like a Marine or something before he got old. He was hard hearing. My project for his class was to make this wooden box. You know, like a small, just like a... like a box, you know, to put stuff in. So I wanted to get the thing done as fast as possible. </p>
 		<p>I figured I could cut classes for the rest of the semester and he couldn't flunk me as long as I, you know, made the thing. So I finished it in a couple days. And it looked pretty lame, but it worked. You know, for putting in or whatnot. So when I showed it to Mr. Pike for my grade, he looked at it and said: 'Is that the best you can do?' </p>
 		<p>At first I thought to myself 'Hell yeah, bitch. Now give me a D and shut up so I can go blaze one with my boys.' I don't know. Maybe it was the way he said it, but... it was like he wasn't exactly saying it sucked. He was just asking me honestly, 'Is that all you got?' And for some reason, I thought to myself: 'Yeah, man, I can do better.' </p>
 		<p>So I started from scratch. I made another, then another. And by the end of the semester, by like box number five, I had built this thing. You should have seen it. It was insane. I mean, I built it out of Peruvian walnut with inlaid zebrawood. It was fitted with pegs, no screws, I sanded it for days, until it was smooth as glass. Then I rubbed all the wood with tung oil so it was rich and dark. It even smelled good. You know, you put nose in it and breathed in, it was... it was perfect. </p>
		<table class=\"table\">
			<thead>
			<tr>
				<th>
					#
				</th>
				<th>
					First Name
				</th>
				<th>
					Last Name
				</th>
				<th>
					Username
				</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<th scope=\"row\">
					1
				</th>
				<td>
					Mark
				</td>
				<td>
					Otto
				</td>
				<td>
					@mdo
				</td>
			</tr>
			<tr>
				<th scope=\"row\">
					2
				</th>
				<td>
					Jacob
				</td>
				<td>
					Thornton
				</td>
				<td>
					@fat
				</td>
			</tr>
			<tr>
				<th scope=\"row\">
					3
				</th>
				<td>
					Larry
				</td>
				<td>
					the Bird
				</td>
				<td>
					@twitter
				</td>
			</tr>
		</tbody>
	</table>";

    $staticBlock
        ->setContent($content)
        ->save();

} catch (Exception $e) {
    Mage::throwException($e->getMessage());
}

$installer->endSetup();
