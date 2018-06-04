<?hh // strict
/*
 *  Copyright (c) 2017-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */


namespace Facebook\HHAST;

use function Facebook\FBExpect\expect;
use namespace HH\Lib\{C, Str, Vec};

final class HackToPHPTest extends TestCase {
  public function testPHPOnlyFeature(): void {

    foreach (\glob("example-files/*.php") as $filename) {
      $res = \exec("./bin/hhast-lint $filename | php -l");
      expect($res)->toEqual("No syntax errors detected in -", "Syntax error in file $filename:\n$res");   
    }

    
  }
}
