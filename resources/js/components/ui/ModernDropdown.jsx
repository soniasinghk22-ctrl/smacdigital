import React, { useState, useRef, useEffect } from 'react';

export default function ModernDropdown({
  options = [],
  selected = [],
  onChange,
  placeholder = "Select services of interest...",
  error = null
}) {
  const [isOpen, setIsOpen] = useState(false);
  const dropdownRef = useRef(null);

  useEffect(() => {
    function handleClickOutside(event) {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
        setIsOpen(false);
      }
    }
    document.addEventListener('mousedown', handleClickOutside);
    return () => document.removeEventListener('mousedown', handleClickOutside);
  }, []);

  const handleToggleOption = (val) => {
    if (selected.includes(val)) {
      onChange(selected.filter(item => item !== val));
    } else {
      onChange([...selected, val]);
    }
  };

  const handleClearAll = (e) => {
    e.stopPropagation();
    onChange([]);
  };

  const displayText = selected.length === 0
    ? placeholder
    : selected.length === 1
      ? selected[0]
      : `${selected.length} services selected`;

  return (
    <div className={`field field-dropdown ${error ? 'is-invalid' : ''}`} ref={dropdownRef}>
      <label className="dropdown-label" id="services-dropdown-label">
        Services of interest
      </label>
      <div className={`modern-dropdown ${isOpen ? 'is-open' : ''}`}>
        <button
          type="button"
          className="dropdown-trigger"
          aria-haspopup="listbox"
          aria-expanded={isOpen}
          aria-labelledby="services-dropdown-label"
          onClick={() => setIsOpen(!isOpen)}
        >
          <span className={`dropdown-trigger-text ${selected.length ? 'has-selection' : ''}`}>
            {displayText}
          </span>
          <span className="dropdown-arrow" aria-hidden="true">
            <svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" strokeWidth="2.2" strokeLinecap="round" strokeLinejoin="round">
              <polyline points="6 9 10 13 14 9"></polyline>
            </svg>
          </span>
        </button>

        {isOpen && (
          <div className="dropdown-panel" role="listbox" aria-multiselectable="true">
            <div className="dropdown-panel-header">
              <span className="dropdown-panel-hint">Select all that apply</span>
              {selected.length > 0 && (
                <button type="button" className="dropdown-clear-btn" onClick={handleClearAll}>
                  Clear all
                </button>
              )}
            </div>
            <div className="dropdown-options">
              {options.map((opt) => {
                const isChecked = selected.includes(opt);
                return (
                  <label key={opt} className={`dropdown-option ${isChecked ? 'is-checked' : ''}`}>
                    <input
                      type="checkbox"
                      name="service"
                      value={opt}
                      checked={isChecked}
                      onChange={() => handleToggleOption(opt)}
                    />
                    <span className="option-custom-check">
                      <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                        <polyline points="3 8.5 6.5 12 13 4"></polyline>
                      </svg>
                    </span>
                    <span className="option-text">{opt}</span>
                  </label>
                );
              })}
            </div>
          </div>
        )}
      </div>
      {error && <p className="field-error">{error}</p>}
    </div>
  );
}
