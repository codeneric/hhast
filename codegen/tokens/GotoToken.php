<?hh
/**
 * This file is generated. Do not modify it manually!
 *
 * @generated SignedSource<<f29d55691140ff4ad1477d45666bd4cf>>
 */
namespace Facebook\HHAST;

final class GotoToken extends EditableToken {

  public function __construct(
    EditableSyntax $leading,
    EditableSyntax $trailing,
  ) {
    parent::__construct('goto', $leading, $trailing, 'goto');
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
