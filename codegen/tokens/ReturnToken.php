<?hh
/**
 * This file is generated. Do not modify it manually!
 *
 * @generated SignedSource<<f581fbd1698dc21adde9127c0b6155d7>>
 */
namespace Facebook\HHAST;

final class ReturnToken extends EditableToken {

  public function __construct(
    EditableSyntax $leading,
    EditableSyntax $trailing,
  ) {
    parent::__construct('return', $leading, $trailing, 'return');
  }

  public function with_leading(EditableSyntax $value): this {
    if ($value === $this->leading()) {
      return $this;
    }
    return new self($value, $this->trailing());
  }

  public function with_trailing(EditableSyntax $value): this {
    if ($value === $this->trailing()) {
      return $this;
    }
    return new self($this->leading(), $value);
  }

  public function rewrite_children(
    self::TRewriter $rewriter,
    ?Traversable<EditableSyntax> $parents = null,
  ): this {
    $parents = $parents === null ? vec[] : vec($parents);
    $parents[] = $this;
    $leading = $this->leading()->rewrite($rewriter, $parents);
    $trailing = $this->trailing()->rewrite($rewriter, $parents);
    if (
      $leading === $this->leading() &&
      $trailing === $this->trailing()
    ) {
      return $this;
    }
    return new self($leading, $trailing);
  }
}
