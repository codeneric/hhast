<?hh
/**
 * This file is generated. Do not modify it manually!
 *
 * @generated SignedSource<<a7abf0b7c81e8f744c1ef7cc6abdd8f9>>
 */
namespace Facebook\HHAST;

final class DoubleQuotedStringLiteralTailToken extends EditableToken {

  public function __construct(
    EditableSyntax $leading,
    EditableSyntax $trailing,
    string $text,
  ) {
    parent::__construct(
      'double_quoted_string_literal_tail',
      $leading,
      $trailing,
      $text,
    );
  }

  public function with_leading(EditableSyntax $value): this {
    if ($value === $this->leading()) {
      return $this;
    }
    return new self($value, $this->trailing(), $this->text());
  }

  public function with_trailing(EditableSyntax $value): this {
    if ($value === $this->trailing()) {
      return $this;
    }
    return new self($this->leading(), $value, $this->text());
  }

  public function with_text(string $value): this {
    if ($value === $this->text()) {
      return $this;
    }
    return new self($this->leading(), $this->trailing(), $value);
  }

  public function rewrite_children(
    self::TRewriter $rewriter,
    ?Traversable<EditableSyntax> $parents = null,
  ): this {
    $parents = $parents === null ? vec[] : vec($parents);
    $parents[] = $this;
    $leading = $this->leading()->rewrite($rewriter, $parents);
    $trailing = $this->trailing()->rewrite($rewriter, $parents);
    $text = $this->text();
    if (
      $leading === $this->leading() &&
      $trailing === $this->trailing() &&
      $text === $this->text()
    ) {
      return $this;
    }
    return new self($leading, $trailing, $text);
  }
}
