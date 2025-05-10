 
  <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  
  <style>
   
 
    
    .chat-header img {
      width: 50px;
      height: 50px;  
      border-radius: 50%;
      border: 1px solid #ddd;
    }
    
    .header-info h3 {
      font-size: 16px;
      font-weight: 600;
    }
    
    .online-status {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 12px;
    }
    
    .status-dot {
      width: 8px;
      height: 8px;
      background-color: #4CAF50;
      border-radius: 50%;
    }
    
    .chat-messages {
      flex: 1;
      padding: 20px;
      overflow-y: auto;font-size: 18px;
      font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;

      background-color: white;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    
    .message {
      display: flex;
      align-items: flex-start;
      max-width: 85%;
      animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .message-left {
      align-self: flex-start;
    }
    
    .message-right {
      align-self: flex-end;
      flex-direction: row-reverse;
    }
    
    .message-avatar {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 8px;
      flex-shrink: 0;
    }
    
    .message-content {
      padding: 12px 16px;
      border-radius: 18px;
      font-size: 14px;
      line-height: 1.5;
      position: relative;
      max-width: calc(100% - 50px);
      word-wrap: break-word;
    }
    
    .message-left .message-content {
      background-color: white;
      border: 1px solid #e0e0e0;
      border-bottom-left-radius: 5px;
    }
    
    .message-right .message-content {
      background: #0062E6 ;
      color: white;
      border-bottom-right-radius: 5px;
    }
    
    /* Structured content styling */
    .message-content strong {
      font-weight: 600;
    }
    
    .message-content em {
      font-style: italic;
    }
    
    .message-content p {
      margin-bottom: 10px;
    }
    
    .message-content ul, .message-content ol {
      margin: 10px 0;
      padding-left: 20px;
    }
    
    .message-content li {
      margin-bottom: 5px;
    }
    
    .message-content h1, .message-content h2, .message-content h3, 
    .message-content h4, .message-content h5, .message-content h6 {
      margin-top: 15px;
      margin-bottom: 10px;
      font-weight: 600;
    }
    
    .chat-footer {
      padding: 15px;
      border-top: 1px solid #ddd;
      background-color: white;
    }
    
    .message-form {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .message-input {
      flex: 1;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 25px;
      outline: none;
      font-size: 14px;
      transition: border 0.3s ease;
    }
    
    .message-input:focus {
      border-color: #0062E6;
    }
    
    .send-button {
      background: #0062E6 ;
      color: white;
      border: none;
      border-radius: 50%;
      width: 45px;
      height: 45px;
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: transform 0.2s ease;
    }
    
    .send-button:hover {
      transform: scale(1.05);
    }
    
    .send-button:disabled {
      opacity: 0.7;
      cursor: not-allowed;
    }
    
    .typing-indicator {
      display: flex;
      align-items: center; 
      gap: 10px;
      padding: 10px;
      background-color: white;
      opacity: 0;
      transition: opacity 0.3s ease;
      align-self: flex-start;
    }
    
    .typing-dots {
      display: flex;
      gap: 3px;
    }
    
    .dot {
      width: 8px;
      height: 8px;
      background-color: #0062E6;
      border-radius: 50%;
      animation: typingAnimation 1.4s infinite;
    }
    
    .dot:nth-child(2) { animation-delay: 0.2s; }
    .dot:nth-child(3) { animation-delay: 0.4s; }
    
    @keyframes typingAnimation {
      0%, 80%, 100% { transform: scale(1); opacity: 0.5; }
      40% { transform: scale(1.2); opacity: 1; }
    }
    
    /* Scrollbar Styling */
    .chat-messages::-webkit-scrollbar {
      width: 6px;
    }
    
    .chat-messages::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    
    .chat-messages::-webkit-scrollbar-thumb {
      background: #c1c1c1;
      border-radius: 10px;
    }
    
    .chat-messages::-webkit-scrollbar-thumb:hover {
      background: #a1a1a1;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
      .chat-container {
        width: 100%; 
      }
      
      .message {
        max-width: 90%;
      }
    }
    
    @media (max-width: 480px) {
      .chat-header img {
        width: 40px;
        height: 40px;
      }
      
      .header-info h3 {
        font-size: 14px;
      }
      
      .message-content {
        font-size: 13px;
        padding: 10px 14px;
      }
    }
    .faq-container {
    background-color: #f5f5f5;
    border-bottom: 1px solid blue;
    transition: all 0.3s ease;
    overflow: hidden;
    max-height: 400px;
  }
  
  .faq-container.collapsed {
    max-height: 50px;
  }
  
  .faq-header {
    padding: 12px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f5f5f5;
    cursor: pointer;
  }
  
  .faq-header h4 {
    margin: 0;
    font-size: 14px;
    font-weight: 500;
    color: #333;
  }
  
  .faq-toggle {
    background: none;
    border: none;
    color: #0062E6;
    cursor: pointer;
    transition: transform 0.3s ease;
  }
  
  .faq-container.collapsed .faq-toggle i {
    transform: rotate(180deg);
  }
  
  .faq-content {
    padding: 0 20px 15px;
    overflow-y: auto;
    max-height: 330px;
  }
  
  .faq-tag-container {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin: 12px 0;
  }
  
  .faq-tag {
    background: #f1f1f1;
    border: none;
    border-radius: 15px;
    padding: 6px 12px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  
  .faq-tag.active {
    background: #0062E6;
    color: white;
  }
  
  .faq-questions {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 15px;
  }
  
  .faq-item {
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.2s ease;
  }
  
  .faq-item:hover {
    border-color: #0062E6;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }
  
  .faq-question {
    padding: 10px 15px;
    font-size: 13px;
    cursor: pointer;
    color: #444;
  }
  
  .faq-content::-webkit-scrollbar {
    width: 6px;
  }
  
  .faq-content::-webkit-scrollbar-track {
    background: #f1f1f1;
  }
  
  .faq-content::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
  }
  
  /* Adjust chat container to accommodate FAQ */
  .chat-container {
    display: flex;
    flex-direction: column;
  }
  
  .chat-messages {
    flex: 1;
    min-height: 0;
  }

  .chat-header {
    justify-content: space-between;
  }
  
  .header-info {
    flex: 1;
    margin-left: 10px;
  }
  
  .history-toggle {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background 0.2s ease;
  }
  
  .history-toggle:hover {
    background: rgba(255, 255, 255, 0.1);
  }
  
  /* Chat History Sidebar */
  .chat-container {
    position: relative;
    overflow: hidden;
  }
  
  .history-sidebar {
  position: absolute;
  top: -300px; /* Initially hidden above */
  left: 0;
  width: 100%;
  height: 300px; /* Height of the top drawer */
  background: white;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  z-index: 1;
  transition: top 0.3s ease;
  display: flex;
  flex-direction: column;
}

  
  .history-sidebar.open {
    right: 0;
  }
  
  .history-header {
    padding: 15px;
    background:  #0062E6 ;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .history-header h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 500;
  }
  
  .history-close {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background 0.2s ease;
  }
  
  .history-close:hover {
    background: rgba(255, 255, 255, 0.2);
  }
  
  .history-content {
    flex: 1;
    overflow-y: auto;
    padding: 10px;
  }
  
  .history-item {
    padding: 12px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    transition: background 0.2s ease;
  }
  
  .history-item:hover {
    background: #f5f7fa;
  }
  
  .history-question {
    font-size: 13px;
    font-weight: 500;
    color: #333;
    margin-bottom: 5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  
  .history-timestamp {
    font-size: 11px;
    color: #888;
  }
  
  .empty-history {
    padding: 20px;
    text-align: center;
    color: #888;
    font-size: 13px;
  }
  
  .history-footer {
    padding: 10px;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: center;
  }
  
  .clear-history {
    background: none;
    border: 1px solid #ddd;
    border-radius: 15px;
    padding: 6px 12px;
    font-size: 12px;
    color: #666;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  
  .clear-history:hover {
    background: #f5f5f5;
    border-color: #ccc;
  }
  .chat-header {
      padding: 15px 20px; 
      color: black;
      display: flex;
      align-items: center;
      gap: 15px;
      border-bottom: 1px solid #ddd;
    } 
</style>

  </style> 
  <div class="chat-container">
    <div class="chat-header">
      <img src="{{ asset('logo.png') }}" alt="SDO Logo">
      <div class="header-info">
        <h3>SDO San Carlos City Pangasinan R1</h3>
        <div class="online-status">
          <div class="status-dot"></div>
          <span>Online</span>
        </div>
      </div>
      
    </div>
    <div class="faq-container" id="faq-container">
      <div class="faq-header">
        <h4>Frequently Asked Questions</h4>
       

        <button class="faq-toggle" id="faq-toggle">
          <i class="fas fa-chevron-up"></i>
        </button>
      </div>
      
      <div class="faq-content">
        <div class="faq-tag-container">
          <button class="faq-tag active" data-category="all">All</button>
          <button class="faq-tag" data-category="enrollment">Enrollment</button>
          <button class="faq-tag" data-category="requirements">Requirements</button>
          <button class="faq-tag" data-category="schools">Schools</button>
          <button class="faq-tag" data-category="programs">Programs</button>
        </div>
        
        <div class="faq-questions">
          <div class="faq-item" data-category="enrollment">
            <div class="faq-question">What are the enrollment dates for this school year?</div>
          </div>
          <div class="faq-item" data-category="enrollment">
            <div class="faq-question">How do I enroll my child in a San Carlos City public school?</div>
          </div>
          <div class="faq-item" data-category="requirements">
            <div class="faq-question">What documents are needed for new student enrollment?</div>
          </div>
          <div class="faq-item" data-category="schools">
            <div class="faq-question">How many public schools are there in San Carlos City?</div>
          </div>
          <div class="faq-item" data-category="programs">
            <div class="faq-question">What special programs does SDO San Carlos City offer?</div>
          </div>
          <div class="faq-item" data-category="programs">
            <div class="faq-question">How can teachers apply for professional development programs?</div>
          </div>
          <div class="faq-item" data-category="requirements">
            <div class="faq-question">What are the requirements for transferring schools within the division?</div>
          </div>
          <div class="faq-item" data-category="schools">
            <div class="faq-question">Where can I find contact information for all schools in the division?</div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="chat-messages" id="chat-messages" style=" background-color:white">
      <div class="message message-left">
        <img class="message-avatar" src="{{('logo.png') }}" alt="Avatar">
        <div class="message-content">
          <p><strong>Welcome to SDO San Carlos City Pangasinan R1!</strong></p>
          <p>I'm your educational AI assistant. How can I help you today with information about our schools, programs, or educational resources?</p>
        </div>
      </div>
    </div>
    <div style="background-color: white;">
    <div class="typing-indicator" id="typing-indicator" style="background-color: white;width:100%">
      <img class="message-avatar" src="{{ asset('logo.png') }}" alt="Avatar">
      <div class="typing-dots">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
      </div>
    </div>
    </div>
    <div class="chat-footer">
      <form class="message-form" id="message-form">
        <input type="text" class="message-input" id="message-input" placeholder="Type your message..." autocomplete="off">
        <button type="submit" class="send-button" id="send-button">
          <i class="fas fa-arrow-up"></i>
        </button>
      </form>
    </div>
  </div>
 
<script>
  $(document).ready(function() {
  // DOM Element References
  const messageForm = $("#message-form");
  const messageInput = $("#message-input");
  const sendButton = $("#send-button");
  const chatMessages = $("#chat-messages");
  const typingIndicator = $("#typing-indicator");
  const faqContainer = $("#faq-container");
  const faqToggle = $("#faq-toggle");
  const historyToggle = $("#history-toggle");
  const historySidebar = $("#history-sidebar");
  const historyClose = $("#history-close");
  const historyContent = $("#history-content");
  const clearHistory = $("#clear-history");
  
  // Chat History Variables
  let chatHistory = [];
  
  // Function to scroll to bottom of messages
  function scrollToBottom() {
    chatMessages.scrollTop(chatMessages[0].scrollHeight);
  }
  
  // Initial scroll to bottom
  scrollToBottom();
  
  // Load chat history from localStorage on page load
  function loadChatHistory() {
    const savedHistory = localStorage.getItem('sdoChatHistory');
    if (savedHistory) {
      chatHistory = JSON.parse(savedHistory);
      updateHistoryDisplay();
    }
  }
  
  // Save chat history to localStorage
  function saveChatHistory() {
    localStorage.setItem('sdoChatHistory', JSON.stringify(chatHistory));
  }
  
  // Add a new question to history
  function addToHistory(question) {
    // Create new history item
    const newItem = {
      id: Date.now(),
      question: question,
      timestamp: new Date().toISOString()
    };
    
    // Add to beginning of array (newest first)
    chatHistory.unshift(newItem);
    
    // Limit history to 20 items
    if (chatHistory.length > 20) {
      chatHistory.pop();
    }
    
    // Save and update display
    saveChatHistory();
    updateHistoryDisplay();
  }
  
  // Format relative time (e.g., "2 hours ago")
  function getRelativeTime(timestamp) {
    const now = new Date();
    const past = new Date(timestamp);
    const diffMs = now - past;
    
    const diffSecs = Math.floor(diffMs / 1000);
    const diffMins = Math.floor(diffSecs / 60);
    const diffHours = Math.floor(diffMins / 60);
    const diffDays = Math.floor(diffHours / 24);
    
    if (diffSecs < 60) {
      return "just now";
    } else if (diffMins < 60) {
      return `${diffMins} minute${diffMins > 1 ? 's' : ''} ago`;
    } else if (diffHours < 24) {
      return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
    } else {
      return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
    }
  }
  
  // Update the history display
  function updateHistoryDisplay() {
    if (chatHistory.length === 0) {
      historyContent.html('<div class="empty-history">No recent conversations</div>');
      return;
    }
    
    let historyHtml = '';
    
    chatHistory.forEach(item => {
      historyHtml += `
        <div class="history-item" data-id="${item.id}">
          <div class="history-question">${item.question}</div>
          <div class="history-timestamp">${getRelativeTime(item.timestamp)}</div>
        </div>
      `;
    });
    
    historyContent.html(historyHtml);
    
    // Add click event to history items
    $(".history-item").click(function() {
      const question = $(this).find(".history-question").text();
      $("#message-input").val(question);
      // Close the sidebar
      historySidebar.removeClass("open");
    });
  }
  
  // Load frequent searches from the server
  function loadFrequentSearches() {
    $.ajax({
      url: "/api/frequent-searches",
      method: 'GET',
      data: { limit: 15 },
      headers: { 'X-CSRF-TOKEN': "{{csrf_token()}}" },
    }).done(function(response) {
      if (response.success && response.data.length > 0) {
        // Create a new category for frequent searches
        if ($('.faq-tag[data-category="frequent"]').length === 0) {
          $('.faq-tag-container').append(
            '<button class="faq-tag" data-category="frequent">Frequent</button>'
          );
        }
        
        // Clear existing frequent search items
        $('.faq-item[data-category="frequent"]').remove();
        
        // Add new frequent search items
        response.data.forEach(function(item) {
          $('.faq-questions').append(`
            <div class="faq-item" data-category="frequent">
              <div class="faq-question">${item.query}</div>
            </div>
          `);
        });
        
        // Reattach click handlers
        attachFaqHandlers();
      }
    }).fail(function() {
      console.error("Failed to load frequent searches");
    });
  }
  
  // Function to attach FAQ click handlers
  function attachFaqHandlers() {
    // FAQ question click handling
    $(".faq-question").off('click').on('click', function() {
      const questionText = $(this).text();
      $("#message-input").val(questionText);
      $("#send-button").click();
    });
    
    // FAQ category filtering
    $(".faq-tag").off('click').on('click', function() {
      // Remove active class from all tags
      $(".faq-tag").removeClass("active");
      // Add active class to clicked tag
      $(this).addClass("active");
      
      const category = $(this).data("category");
      
      if (category === "all") {
        // Show all items
        $(".faq-item").show();
      } else {
        // Hide all items
        $(".faq-item").hide();
        // Show only items matching the category
        $(`.faq-item[data-category="${category}"]`).show();
      }
    });
  }
  
  // =========== Event Handlers ===========
  
  // Handle form submission
  messageForm.submit(function(event) {
    event.preventDefault();
    const messageText = messageInput.val().trim();
    
    if (messageText === '') return;
    
    // Add to history
    addToHistory(messageText);
    
    // Disable input and button
    messageInput.prop('disabled', true);
    sendButton.prop('disabled', true);
    
    // Add user message to chat
    chatMessages.append(`
      <div class="message message-right">
        <div class="message-content">${messageText}</div>
        <img class="message-avatar" src="{{ asset('chat_icon.svg') }}" alt="Avatar">
      </div>
    `);
    
    scrollToBottom();
    
    // Show typing indicator
    typingIndicator.css("opacity", "1");
    scrollToBottom();
    
    // Clear input field
    messageInput.val('');
    
    // Send message to server
    $.ajax({
      url: "/chat",
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': "{{csrf_token()}}" },
      data: { "model": "jamba-large-1.6", "content": messageText },
      timeout: 60000 // 60 second timeout
    }).done(function(response) {
      // Hide typing indicator
      typingIndicator.css("opacity", "0");
      
      // Add bot response to chat (the response should already be HTML formatted from the controller)
      chatMessages.append(`
        <div class="message message-left">
          <img class="message-avatar" src="{{ asset('logo.png') }}" alt="Avatar">
          <div class="message-content">${response}</div>
        </div>
      `);
      
      scrollToBottom();
      
      // Re-enable input and button
      messageInput.prop('disabled', false);
      sendButton.prop('disabled', false);
      messageInput.focus();
    }).fail(function() {
      // Hide typing indicator
      typingIndicator.css("opacity", "0");
      
      // Show error message
      chatMessages.append(`
        <div class="message message-left">
          <img class="message-avatar" src="{{ asset('logo.png') }}" alt="Avatar">
          <div class="message-content">
            <p><strong>Sorry, I'm having trouble responding right now.</strong></p>
            <p>Please try again in a few moments or refresh the page if the problem persists.</p>
          </div>
        </div>
      `);
      
      scrollToBottom();
      
      // Re-enable input and button
      messageInput.prop('disabled', false);
      sendButton.prop('disabled', false);
      messageInput.focus();
    });
  });
  
  // FAQ toggle functionality
  faqToggle.click(function() {
    faqContainer.toggleClass("collapsed");
  });
  
  // Toggle history sidebar
  historyToggle.click(function() {
    historySidebar.toggleClass("open");
    // Update timestamps when opening
    if (historySidebar.hasClass("open")) {
      updateHistoryDisplay();
    }
  });
  
  // Close history sidebar
  historyClose.click(function() {
    historySidebar.removeClass("open");
  });
  
  // Clear all history
  clearHistory.click(function() {
    if (confirm("Are you sure you want to clear all conversation history?")) {
      chatHistory = [];
      saveChatHistory();
      updateHistoryDisplay();
    }
  });
  
  // =========== Initialization ===========
  
  // Focus input field on page load
  messageInput.focus();
  
  // Load history on page load
  loadChatHistory();
  
  // Initial FAQ handlers attachment
  attachFaqHandlers();
  
  // Load frequent searches when the page loads
  loadFrequentSearches();
  
  // Refresh frequent searches every 5 minutes
  setInterval(loadFrequentSearches, 300000);
});
</script> 