import React, { useState, useEffect } from 'react';

export default function TypingTitle({
  lines = [
    "We don't sell hours.",
    "We build pipelines."
  ]
}) {
  const [currentLineIndex, setCurrentLineIndex] = useState(0);
  const [displayedText, setDisplayedText] = useState(lines.map(() => ''));
  const [isTyping, setIsTyping] = useState(true);

  useEffect(() => {
    let charIndex = 0;
    let lineIdx = 0;
    const typingSpeed = 50;
    const linePause = 300;
    let timeoutId = null;

    function tick() {
      if (lineIdx >= lines.length) {
        setIsTyping(false);
        return;
      }

      const targetLine = lines[lineIdx];
      charIndex++;

      setDisplayedText((prev) => {
        const next = [...prev];
        next[lineIdx] = targetLine.slice(0, charIndex);
        return next;
      });

      if (charIndex < targetLine.length) {
        timeoutId = setTimeout(tick, typingSpeed);
      } else {
        lineIdx++;
        charIndex = 0;
        setCurrentLineIndex(lineIdx);
        timeoutId = setTimeout(tick, linePause);
      }
    }

    timeoutId = setTimeout(tick, 200);

    return () => {
      if (timeoutId) clearTimeout(timeoutId);
    };
  }, [lines]);

  return (
    <h1 id="hero-title" className={`hero-title ${isTyping ? 'is-typing' : ''}`}>
      <span
        className={`hero-title-line ${currentLineIndex === 0 && isTyping ? 'is-active' : ''}`}
        data-type={lines[0]}
      >
        {displayedText[0] || (isTyping ? '' : lines[0])}
      </span>
      <br />
      <em
        className={`hero-title-line ${currentLineIndex === 1 && isTyping ? 'is-active' : ''}`}
        data-type={lines[1]}
      >
        {displayedText[1] || (isTyping ? '' : lines[1])}
      </em>
    </h1>
  );
}
